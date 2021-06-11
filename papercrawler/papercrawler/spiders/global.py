# coding:utf-8
import time
import json
from scrapy import Spider
from scrapy.http import Request
from papercrawler.items import PapercrawlerItem
from papercrawler.settings import PAPER_TOPIC, JOURNAL_HEAD, JOURNAL_TAIL, VOLUMN_START, VOLUMN_END


class GlobalSpider(Spider):
    name = "global"
    allowed_domains = ["sciencedirect.com"]
    start_urls = [f"https://www.sciencedirect.com/browse/"\
                 "journals-and-books?page={i}&contentType=JL&subject={PAPER_TOPIC}" \
                 for i in range(JOURNAL_HEAD, JOURNAL_TAIL + 1)]

    def parse(self, response):
        journals = response.xpath("//a[@class='anchor js-publication-title']//@href").getall()
        for journal in journals:
            for volume in range(VOLUMN_START, VOLUMN_END + 1):
                yield Request(url=f"https://www.sciencedirect.com{journal}/vol/{volume}/suppl/C", callback=self.parse_journal)
            
    def parse_journal(self, response):
        articles = response.xpath("//a[@class='anchor article-content-title u-margin-xs-top u-margin-s-bottom']//@href").getall()
        articles = articles[1:]
        for article in articles:
            yield Request(url="https://www.sciencedirect.com"+article, callback=self.parse_article)

    def parse_article(self, response):
        # basic information
        journal = response.xpath("//a[@class='publication-title-link']/text()").extract_first()
        if journal is None:
            journal = response.xpath("//h2[@class='u-hide-from-sm publication-title-link u-h3']/text()").extract_first()
        title = response.xpath("//span[@class='title-text']/text()").extract_first()
        keywords = response.xpath("//div[@class='keyword']/span/text()").getall()

        # store volume, issue, page together in the jplace field in the database
        volume_issue = response.xpath("//div[@class='text-xs']/a/text()").extract_first()
        pages = response.xpath("//div[@class='text-xs']/text()").getall()[-1]
        if "Pages " not in pages:
            pages = ''
        place = volume_issue + pages
        
        # parse json to get time, author, affiliation
        json_data = json.loads(response.xpath("//script[@type='application/json']/text()").extract_first())

        try:
            time_data = json_data["article"]["dates"]
            available_date = time.strptime(time_data["Available online"], "%d %B %Y")
            journal_date = time.strptime(time_data["Publication date"], "%d %B %Y")
        except:
            return

        try:
            author_data = json_data["authors"]["content"][0]["$$"]
        except IndexError:
            return
        authors = {}
        affiliations = {}

        for i in author_data:
            if i["#name"] == "author":
                name = i["$$"][0]["_"] + ' ' + i["$$"][1]["_"]
                authors[name] = []
                for j in i["$$"]:
                    if j["#name"] == "cross-ref" and "aff" in j["$"]["refid"]:
                        authors[name].append(j["$$"][0]["_"])
            elif i["#name"] == "affiliation":
                if i["$$"][0]["#name"] == "textfn":
                    affiliations["none"] = i["$$"][0]["_"]
                elif i["$$"][0]["#name"] == "label":
                    label = i["$$"][0]["_"]
                    affiliations[label] = i["$$"][1]["_"]
        if [] in authors.values() and "none" not in affiliations.keys():
            return

        item = PapercrawlerItem()
        item["journal"] = journal
        item["title"] = title
        item["keywords"] = keywords
        item["place"] = place
        item["available_date"] = available_date
        item["journal_date"] = journal_date
        item["authors"] = authors
        item["affiliations"] = affiliations
        yield item

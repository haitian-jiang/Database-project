# coding:utf-8
import time
import json
from scrapy import Spider
from scrapy.http import Request

from papercrawler.items import PapercrawlerItem
# from papercrawler.loader import FirmwareLoader



class PageSpider(Spider):
    name = "page"
    allowed_domains = ["sciencedirect.com"]
    start_urls = [
        "https://www.sciencedirect.com/science/article/abs/pii/S0957417405000059",
        "https://www.sciencedirect.com/science/article/abs/pii/S0377221715004208",
        "https://www.sciencedirect.com/science/article/abs/pii/S0957417411006749",
        "https://www.sciencedirect.com/science/article/abs/pii/S0957417414005119",
        "https://www.sciencedirect.com/science/article/abs/pii/S0950705111001353",
        "https://www.sciencedirect.com/science/article/abs/pii/S0957417408002996",
        "https://www.sciencedirect.com/science/article/abs/pii/S0378426604001050", 
        "https://www.sciencedirect.com/science/article/abs/pii/S0305054899001495",  # single author without tag
        "https://www.sciencedirect.com/science/article/abs/pii/S2215036621000729",  # single author with tag
        "https://www.sciencedirect.com/science/article/abs/pii/S095741740600217X",  # mutiple author single affiliation
        "https://www.sciencedirect.com/science/article/abs/pii/S0048733317300422",  # multiple author mutiple affiliation
        "https://www.sciencedirect.com/science/article/pii/S2215036621000845"  # multiple author mutiple affiliation
#         "https://www.sciencedirect.com/science/article/abs/pii/S0002929721001877",  # 不行
        "https://www.sciencedirect.com/science/article/pii/S2212671614001024"
    ]

    def parse(self, response):
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

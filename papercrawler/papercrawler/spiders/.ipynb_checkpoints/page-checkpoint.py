# coding:utf-8
from scrapy import Spider
from scrapy.http import Request

# from papercrawler.items import FirmwareImage
# from papercrawler.loader import FirmwareLoader

import urllib
import json
import re


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
    ]

    def parse(self, response):
        journal = response.xpath("//a[@class='publication-title-link']/text()").extract_first()
        volume_issue = response.xpath("//div[@class='text-xs']/a/text()").extract_first()
        _, month, pages = response.xpath("//div[@class='text-xs']/text()").getall()
        pages = pages.strip(", ")
        title = response.xpath("//span[@class='title-text']/text()").extract_first()
        keywords = response.xpath("//div[@class='keyword']/span/text()").getall()
#         print(journal, title, volume_issue, month, pages, keywords, sep='\n', end='\n\n\n')
        
        json_data = json.loads(response.xpath("//script[@type='application/json']/text()").extract_first())
        json_data = json_data["authors"]["content"][0]["$$"]
        
        authors = {}
        affiliations = {}

        for i in json_data:
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
        print(authors)
        print(affiliations, '\n\n\n\n')
        
        
        
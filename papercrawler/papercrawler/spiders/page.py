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
        "https://www.sciencedirect.com/science/article/abs/pii/S0305054899001495",
        "https://www.sciencedirect.com/science/article/abs/pii/S095741740600217X",
        "https://www.sciencedirect.com/science/article/abs/pii/S0957417405000059",
        "https://www.sciencedirect.com/science/article/abs/pii/S0377221715004208",
        "https://www.sciencedirect.com/science/article/abs/pii/S0957417411006749",
        "https://www.sciencedirect.com/science/article/abs/pii/S0957417414005119",
        "https://www.sciencedirect.com/science/article/abs/pii/S0950705111001353",
        "https://www.sciencedirect.com/science/article/abs/pii/S0957417408002996",
        "https://www.sciencedirect.com/science/article/abs/pii/S0378426604001050", 
        "https://www.sciencedirect.com/science/article/abs/pii/S0048733317300422"
    ]

    def parse(self, response):
        journal = response.xpath("//a[@class='publication-title-link']/text()").extract_first()
        volume_issue = response.xpath("//div[@class='text-xs']/a/text()").extract_first()
        _, month, pages = response.xpath("//div[@class='text-xs']/text()").getall()
        pages = pages.strip(", ")
        title = response.xpath("//span[@class='title-text']/text()").extract_first()
        keywords = response.xpath("//div[@class='keyword']/span/text()").getall()
        print(journal, title, volume_issue, month, pages, keywords, sep='\n', end='\n\n\n')

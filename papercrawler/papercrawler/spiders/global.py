# coding:utf-8
from scrapy import Spider
from scrapy.http import Request

# from papercrawler.items import FirmwareImage
# from papercrawler.loader import FirmwareLoader

import urllib
import json
import re

# from .page import parse_article as parse_article_page

class GlobalSpider(Spider):
    name = "global"
    allowed_domains = ["sciencedirect.com"]
    start_urls = [f"https://www.sciencedirect.com/browse/journals-and-books?page={i}&contentType=JL&subject=computer-science" for i in range(3, 4)]

    def parse(self, response):
        journals = response.xpath("//a[@class='anchor js-publication-title']//@href").getall()
        for journal in journals:
            for volume in range(20, 21):
                yield Request(url=f"https://www.sciencedirect.com{journal}/vol/{volume}/suppl/C", callback=self.parse_journal)
            
    def parse_journal(self, response):
        articles = response.xpath("//a[@class='anchor article-content-title u-margin-xs-top u-margin-s-bottom']//@href").getall()
        articles = articles[1:]
        for article in articles:
            yield Request(url="https://www.sciencedirect.com"+article, callback=self.parse_article)

    def parse_article(self, response):
        # parse_article_page(response)
        pass
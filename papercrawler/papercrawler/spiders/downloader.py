# coding:utf-8
from scrapy import Spider
from scrapy.http import Request
import json

class DownloadSpider(Spider):
    name = "download"
    allowed_domains = ["sciencedirect.com"]
    start_urls = ["https://www.sciencedirect.com/journal/graphical-models"]

    def parse(self, response):
#         with open("graphical-models.html",'w') as f:
#             f.write(response.text)
        json_data = response.xpath("//script[@type='application/json']/text()").extract_first()
        print(json_data[:10])
#         d = eval(json_data)
#         s = json.dumps(d)
        
        s = json_data.replace(r'\"', r'"')
        with open("data.json",'w') as f:
            f.write(s)
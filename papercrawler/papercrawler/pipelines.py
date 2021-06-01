# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://docs.scrapy.org/en/latest/topics/item-pipeline.html


# useful for handling different item types with a single interface
import pymysql
from itemadapter import ItemAdapter


class PapercrawlerPipeline:
    db = pymysql.connect(host='101.94.138.133', user='root', passwd='MyPasswd', db='paper', charset='utf8')
    def process_item(self, item, spider):
        journal = item.get("journal")
        title = item.get("title")
        keywords = item.get("keywords")
        place = item.get("place")
        available_date = item.get("available_date")
        journal_date = item.get("journal_date")
        authors = item.get("authors")
        affiliations = item.get("affiliations")

        print("\n\n\n", journal, title, keywords, place, available_date, journal_date, authors, affiliations, sep="\n", end="\n\n\n\n")
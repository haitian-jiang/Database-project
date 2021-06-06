import pdfplumber
import sys
import json


def process_data(data):
    del data["doi"]
    del data["robots"]
    del data["Creator"]
    del data["CreationDate"]
    del data["CrossMarkDomains[1]"]
    del data["CrossMarkDomains[2]"]
    del data["CrossmarkDomainExclusive"]
    del data["CrossmarkMajorVersionDate"]
    del data["ElsevierWebPDFSpecifications"]

    journ = data["Subject"]
    journ = journ[:journ.find(',')]
    data["jname"] = journ
    del data["Subject"]

    mod = data["ModDate"]
    i = mod.find(":")
    mod = mod[i+1: i+9]
    data["publish_date"] = mod
    del data["ModDate"]
    
    return data


def main():
    filename = sys.argv[1]
    handler = pdfplumber.open("upload/"+filename)
    data = process_data(handler.metadata)
    print(json.dumps(data))


if __name__ == '__main__':
    main()

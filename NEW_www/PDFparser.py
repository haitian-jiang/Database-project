import pdfplumber
import sys


def main():
    filename = sys.argv[1]
    handler = pdfplumber.open("upload/"+filename)
    data = handler.metadata
    print(data)


if __name__ == '__main__':
    main()

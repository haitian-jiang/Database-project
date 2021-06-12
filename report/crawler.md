### 爬虫文档

本爬虫使用scrapy框架构建，功能是爬取sciencedirect([https://www.sciencedirect.com/](https://www.sciencedirect.com/))上的论文描述部分，可以通过参数设置指定想要爬取的文章分类、新旧程度、所属期刊等。

介绍scrapy

#### 网页页面及URL分析

##### 主页URL分析

sciencedirect的所有目录位于[https://www.sciencedirect.com/browse/journals-and-books](https://www.sciencedirect.com/browse/journals-and-books)，可以在页面上勾选或者通过get方法传参`contentType=JL`获取所有期刊目录。类似地，可以在页面上点击按钮或者通过get方法传参`subject=学科名`来获得该学科分类下的所有期刊目录。对于一页放不下的期刊目录，通过`page`参数来控制，从而不需要在HTML代码中解析获得下一页的链接。以上传参需要的参数均可由爬虫使用者（管理员用户）在设置中给定，爬虫代码将读取设置并据此进行爬取。

##### 期刊目录HTML分析及期刊URL分析

分析HTML源代码发现期刊目录中每一个期刊的链接对应一个拥有`anchor js-publication-title`属性的`<a>`标签，所以可以采用xpath进行解析。解析后得到该页面上所有期刊的链接。期刊的链接直接在可以URL中指定期刊名和卷号，而不需要使用get方法传参，URL形如[https://www.sciencedirect.com/{journal}/vol/{volume}/suppl/C](https://www.sciencedirect.com/{journal}/vol/{volume}/suppl/C)。其中volume为数字，表示了所爬取的文章的新旧程度，此参数的范围也可以由爬虫使用者在设置中给出。

通过期刊的URL可以对其HTML内容进行请求，请求后使用xpath进行解析得到该卷中每篇文章的URL链接。

##### 论文HTML提取

在每篇文章对应的页面上，可以通过xpath解析HTML元素得到期刊名、文章名、关键字列表、卷号期号、页码。其余的作者和作者所属机构的信息需要点击才能在页面上看到，但是模拟页面JavaScript脚本执行代价过大。最终通过解析网页附属json数据可以得到作者、机构、发表时间、期刊时间等的原始数据，再通过一定的处理和对应，获得了需要爬取的全部数据。

#### 爬虫与数据库交互

通过增加middleware和items可以对爬取到的数据进行进一步的写库等操作。

items.py中将爬到的数据封装成scrapy定义的字段格式，再由middleware进行解包。middleware先建立一个到数据库的连接，将文章名、日期、期刊名、版号写入paper表，而后从paper表进行查询，得到插入文章的id，再对应插入author表和keyword表。

#### 爬虫系统安装部署说明


# 這是用來抓家樂福巧克力圖片及文字的爬蟲檔案
# 爬完資料寫進CSV後 又改成抓圖片  邊爬邊改 成功了就註解掉 所以很亂

import urllib.request as req
from bs4 import BeautifulSoup
import time
import csv

# url = "https://www.ptt.cc/bbs/movie/index.html"
# header ={"User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36"}

# request = req.Request(url, headers=header)

# with req.urlopen(request ) as response:
#     data= response.read().decode("utf-8")

# # print(data)
# root = bs4.BeautifulSoup(data, "html.parser")
# # print(root.title.string)

# # titles= root.find("div", class_="title")
# # print(titles.a.string)

# titles= root.find_all("div", class_="title")
# for title in titles:
#     if title.a != None:
#         print(title.a.string)

n = 0
# ------------------------------------------
# for page in  range(0, 409, 24):
for page in  range(1):
    url = f"https://online.carrefour.com.tw/zh/%E9%A3%B2%E6%96%99%E9%9B%B6%E9%A3%9F/%E7%B3%96%E6%9E%9C%E5%B7%A7%E5%85%8B%E5%8A%9B%E5%8F%A3%E9%A6%99%E7%B3%96/%E5%B7%A7%E5%85%8B%E5%8A%9B?cgid=3017&start={page}"
    header ={"User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36"}

    request = req.Request(url, headers=header)

    with req.urlopen(request ) as response:
        data= response.read().decode("utf-8")

    # print(data)

    root = BeautifulSoup(data, "html.parser")
    # print(root)

    # img_tag= root.find("img", class_="m_lazyload")
    # print(img_tag)
    
    a_tags = root.find_all("a", class_="gtm-product-alink")
    for a_tag in a_tags:
        # print(a_tag)
        n +=1
        print(a_tag['data-pid'],a_tag['data-name'],a_tag['data-price'],a_tag['data-brand'],"99",n )


    # img_tags = root.find_all("img", class_="m_lazyload")
   
    # for img_tag in img_tags:
    #     n +=1
    #     product = img_tag['alt']
        
    #     img_url = img_tag["src"].split("?")[0]
    #     # print(img_url )
    #     fname=img_url.split("/")[-1]
    #     # print(product,fname, n)
        
        
        with open('product.csv', 'a', newline='',  encoding='utf-8-sig') as csvfile:
            writer = csv.writer(csvfile)
            # writer.writerow([product,fname, n ])
            writer.writerow([a_tag['data-pid'],a_tag['data-name'],a_tag['data-price'],a_tag['data-brand'],n , "99"])


        # 抓圖區塊
        # with req.urlopen(img_url ) as response:
        #     with open(f"images/{fname}","wb") as file_path:
        #         info = response.read()
        #         file_path.write(info)

        time.sleep(1)
        print("Hi sleep  1 second")
    time.sleep(5)
    print("Hi sleep 5 second")


        






    

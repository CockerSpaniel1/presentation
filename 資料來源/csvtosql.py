#這是爬下來的CSV 整理成要寫進資料庫的格式
import csv


with open('product.csv', 'r',encoding='utf-8-sig') as csvfile:
    reader = csv.reader(csvfile)
    with open("productSQL.txt","w",encoding='utf-8-sig') as f:

        for i in reader:
            print(i)    
            f.write(f"('{i[0]}','{i[1]}','{i[3]}',{i[2]})")
            f.write(",")
            


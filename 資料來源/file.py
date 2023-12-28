#這用來整理圖片檔名的檔案 把雜七雜八的檔名還有副檔名(jpeg)修改成 產品ID.jpg 格式
#部分png則是用線上轉jpg後 再來這邊整理


import os
path = os.getcwd()
print(path)
a=os.listdir("images/")
print(a)

g=len(a)
j=0
for i in range(0, g):
    # filename = a[i].rsplit(".jpg",1)[0]
    # print(f'{filename}')
    # os.rename(f'./images/{a[i]}', f'./images/result/{filename}')


    
    if a[i].endswith(".jpg"):
        j+=1
        # filename = a[i].rsplit(".jpeg",1)[0]
        # print(f'{filename}')
        # os.rename(f'./images/rougejpg/{a[i]}', f'./images/rougejpg/{filename}.jpg')
print(j)
print(g)
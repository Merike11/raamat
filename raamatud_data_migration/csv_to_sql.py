# -*- coding: cp1252 -*-
import os

SQL_FILE = 'sql_import.sql'
TSV_NAME = "raamatud_nimekiri_tab.txt"
SPLIT_OPERATOR = "\t"

file = open(TSV_NAME)
books = []
for line in file:
    line.strip
    books.append(line.split(SPLIT_OPERATOR))
file.close()

if os.path.exists(SQL_FILE):
    os.remove(SQL_FILE)

with open(SQL_FILE, 'a') as sql_file:
    for book in books:
        for column in range(len(book)):
            book[column] = book[column].strip()
            book[column] = book[column].replace("''", "'")
            book[column] = book[column].replace('"', "'")
            book[column] = book[column].replace("´", "\'")
            if book[column] == "":
                book[column] = "NULL"
        sql_file.write('INSERT INTO'
                       ' raamat_import.raamatud_skriptist'
                       '(id,autor,pealkiri,sari,koide,žanr,kirjastus,aasta,kogus,laenutatud)'
                       ' VALUES ({0},"{1}","{2}","{3}","{4}","{5}","{6}","{7}","{8}","{9}");\n'
                       .format(book[0], book[1], book[2], book[3], book[4], book[5], book[6], book[7], book[8],
                               book[9]))

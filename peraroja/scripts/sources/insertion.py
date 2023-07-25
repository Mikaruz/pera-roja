from mysql.connector import Error
import mysql.connector
from random_data import data, data2


try:
    connection = mysql.connector.connect(
        host="localhost", port=3306, user="root", password="", db="peraroja"
    )

    if connection.is_connected():
        cursor = connection.cursor()
        cursor.executemany(
            """INSERT INTO users_data (id, userid, nombre, apellido, ciudad, direccion, postal, telefono, genero, altura, peso, nivel, objetivo, edad) 
                                VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)""",
            data,
        )

        

        cursor.executemany(
            """INSERT INTO users (id, email, password) 
                                VALUES (%s, %s, %s)""",
            data2,
        )

        
        if len(data) == cursor.rowcount:
            connection.commit()
            print("{} rows inserted.".format(len(data)))
        else:
            connection.rollback()
except Error as ex:
    print("Error during connection: {}".format(ex))
finally:
    if connection.is_connected():
        connection.close()
        print("Connection closed.")

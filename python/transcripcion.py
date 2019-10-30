import numpy as np
from tensorflow.python.keras.preprocessing.image import load_img, img_to_array
from tensorflow.python.keras.models import load_model
from os import listdir
from shutil import rmtree
import os
import cv2

longitud, altura = 150, 150
modelo = './model/model2v(1)y2.h5'
pesos = './model/weights2v(1)y2.h5'

cnn = load_model(modelo)
cnn.load_weights(pesos)

def predict(file):
    x = load_img(file, target_size=(longitud, altura))
    x = img_to_array(x)
    x = np.expand_dims(x, axis=0)
    arreglo = cnn.predict(x)  # Retorna un arreglo de dos dimenciones [[1,0,0]] con la clase
    resultado = arreglo[0]  # Resultado es igual a los resultados almacenados en el arreglo de dos dimenciones
    respuesta = np.argmax(resultado)
    #    print(resultado)
    #    print(respuesta)
    return respuesta


# print('/content/drive/My Drive/Trabajo Terminal/Transcript/Transcript/data/train/A/a_('+repr(i+1)+').jpg')
# aux = predict('/content/drive/My Drive/Trabajo Terminal/Transcript/Transcript/data/train/A/a_ (3).jpg')



dir = 'localhost/Transcript/python/'
list = listdir(dir)
lista = []
for i in list:
    lista.append(int(i))
lista.sort()

print(lista)
transcripcion = ""
for i in lista:
    texto = ""
    letras = listdir(dir+repr(i))
    letras.sort()
    for j in letras:
        file = dir + repr(i) + "/" + j
        if os.stat(file).st_size != 0:
            aux = predict(file)
            if aux == 0:
                texto += "a"
            elif aux == 1:
                texto += "b"
            elif aux == 2:
                texto += "c"
            elif aux == 3:
                texto += "d"
            elif aux == 4:
                texto += "de"
            elif aux == 5:
                texto += "e"
            elif aux == 6:
                texto += "en"
            elif aux == 7:
                texto += "f"
            elif aux == 8:
                texto += "g"
            elif aux == 9:
                texto += "h"
            elif aux == 10:
                texto += "i"
            elif aux == 11:
                texto += "j"
            elif aux == 12:
                texto += "l"
            elif aux == 13:
                texto += "m"
            elif aux == 14:
                texto += "n"
            elif aux == 15:
                texto += "ñ"
            elif aux == 16:
                texto += "o"
            elif aux == 17:
                texto += "p"
            elif aux == 18:
                texto += "q"
            elif aux == 19:
                texto += "que"
            elif aux == 20:
                texto += "r"
            elif aux == 21:
                texto += "s"
            elif aux == 22:
                texto += "t"
            elif aux == 23:
                texto += "u"
            elif aux == 24:
                texto += "v"
            elif aux == 25:
                texto += "y"
            elif aux == 26:
                texto += "z"
    print("Eliminando -> "+dir + repr(i) + "/")
#    rmtree(dir + repr(i) + "/")
    transcripcion += " " + texto+" ->"+repr(i)+" "
print(transcripcion)

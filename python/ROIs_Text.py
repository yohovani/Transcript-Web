import cv2
import numpy as np
import os
from os import listdir
import argparse

# construct the argument parser and parse the arguments
ap = argparse.ArgumentParser()
ap.add_argument("-i", "--id", type=str,
	help="path to input dir of image")
args = vars(ap.parse_args())

list = listdir('./../../python/transcription/'+args["id"])
list.sort()
if not os.path.exists('./../../python/transcription/Letras/'+args["id"]):
	os.mkdir('./../../python/transcription/Letras/'+args["id"])
for i in list:
	auxDir = i.split('.')[0]
	dir = './../../python/transcription/Letras/'+args["id"]+'/'+auxDir+"/"
	print (dir)
	if not os.path.exists(dir):
		os.mkdir(dir)
	file = './../../python/transcription/'+args["id"]+"/"+i
	if os.stat(file).st_size != 0:
		image = cv2.imread(file)
		gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
		#gray = cv2.equalizeHist(gray)
		(height, weight) = image.shape[:2]
		#Escala de Grises
#		cv2.imshow('gray', gray)
		#cv2.waitKey(0)


		#Bynary
		ret,th = cv2.threshold(gray,127,255,cv2.THRESH_BINARY_INV)

		#Dilatation
		kernel = np.ones((2,2), np.uint8)
		img_dilation = cv2.dilate(th, kernel, iterations=1)

		#Deteccion de la versión de Opencv
		cv2MajorVersion = cv2.__version__.split(".")[0]

		if int(cv2MajorVersion) == 4:
			ctrs, hier = cv2.findContours(img_dilation.copy(), cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
		else:
			im2, ctrs, hier = cv2.findContours(img_dilation.copy(), cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
		sorted_ctrs = sorted(ctrs, key=lambda ctr: cv2.boundingRect(ctr)[0])
		aux = 0
		img_aux = image.copy()
		for i, ctr in enumerate(sorted_ctrs):
			x, y, w, h = cv2.boundingRect(ctr)

			roi = image[y:y+h, x:x+w]


			if w > 10 and h > 10: 
				if (y-20) >= 0 and (y+h+20) < height and (x-15) >= 0 and (x+w+15) < weight:
					cv2.imwrite(dir+"/"+repr(aux)+'.png', gray[y-20:y+h+20, x-15:x+w+15])
				else:
					cv2.imwrite(dir+"/"+repr(aux)+'.png', gray[y:y+h, x:x+w])
				cv2.rectangle(image, (x,y), (x+w, y+h),(0,0,255),1)
				#Imagenes binarizadas y con la deteccion de letras
#				cv2.imwrite('/home/yohovani/Documents/opencv-text-detection/Deteccion/'+auxDir+'.png', th)
#				cv2.imwrite('/home/yohovani/Documents/opencv-text-detection/Deteccion/'+auxDir+'_1.png', image)
				aux+=1
#	cv2.imshow('Areas Marcadas', image)
#cv2.waitKey(0)

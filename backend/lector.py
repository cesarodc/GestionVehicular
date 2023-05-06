#! C:/Users/CescO/AppData/Local/Programs/Python/Python310/python.exe
import pytesseract as tess
import pytesseract as tsc
import sys
import os

#Funcion que recibe los datos mandados por metodo GET
ruta = sys.argv[1]


#Aqui se cambia la direccion donde se tiene instalada la extension, ya que si no, no servira el codigo
tess.pytesseract.tesseract_cmd = r"C:\Program Files\Tesseract-OCR\tesseract.exe"


#Se leen los caracteres en la imagen que cumplan con la whitelist
texto = tsc.image_to_string(ruta, config='--psm 10 --oem 3 -c tessedit_char_whitelist=ABCDEFGHIJKLMNOPQRSTUVWXYZ-1234567890')

#Se imprime en formato html y se redirecciona.
print('Content-Type: text/html\r\n')
print('<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=../Ver_Lugar.php?placas='+texto+'"> </head>')

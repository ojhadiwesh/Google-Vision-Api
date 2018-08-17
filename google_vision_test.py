# -*- coding: utf-8 -*-
"""
Created on Wed Jun 27 11:36:59 2018

@author: dojha
"""

import io
import os
from google.cloud import vision
from google.cloud.vision import types

client= vision.ImageAnnotatorClient()

file= os.path.join(
        os.path.dirname(__file__), 'dot3.jpg')
with io.open(file, 'rb') as image_file:
    content=image_file.read()

image= types.Image(content=content)
response= client.text_detection(image=image)
texts= response.text_annotations
print('Texts;')
for text in texts:
    print('\n"{}"'.format(text.description))

    vertices = (['({},{})'.format(vertex.x, vertex.y)
                    for vertex in text.bounding_poly.vertices])

    

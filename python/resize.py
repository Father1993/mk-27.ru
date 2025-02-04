import sys
url = sys.argv[1]
scale = sys.argv[2]

if (scale == "2"):
	model = "FSRCNN_x2.pb"
elif (scale == "3"):
	model = "FSRCNN_x3.pb"
elif (scale == "4"):
	model = "FSRCNN_x4.pb"
elif (scale == "8"):
	model = "LapSRN_x8.pb"

import os
os.environ['OPENBLAS_NUM_THREADS'] = '1'

import cv2
from cv2 import dnn_superres

# Create an SR object
sr = dnn_superres.DnnSuperResImpl_create()

# Read image
image = cv2.imread(url)

# Read the desired model
path = "/home/bitrix/www/python/model/" + model
sr.readModel(path)

# Set the desired model and scale to get correct pre- and post-processing
sr.setModel("lapsrn", 8)

# Upscale the image
result = sr.upsample(image)

# Save the image
cv2.imwrite(url, result)
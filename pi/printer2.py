# -*- coding: utf-8 -*-

__author__ = 'Wsine'
__date__ = '2015-11-14'

import os
import time
import threading

def loop():
	while True:
		os.system('php getFile2.php')
		time.sleep(60)

def main():
	# 获取当前脚本所在的路径
	cur_dir = os.getcwd()
	begin(0xbc) # contrast - may need tweaking for each display

	while True:
		print_code = input("Please input your print code: ")
		if print_code == '147896325':
			break
		os.system('php getFile2.php')
		boolSearch = False
		cmd = ''
		for root, dirs, files in os.walk(cur_dir):
			print '------------------- once------------------'
			for file_ in files:
				filePureName = file_.split('.')[0]
				if filePureName == print_code :
					boolSearch = True
					print 'File is printing now'
					gotoxy(8,2)
					text("File is printing now")
					print file_
					if file_.endswith('.pdf') :
						cmd = 'lp ' + file_
						os.system(cmd)
						break
					else :
						cmd = 'libreoffice --invisible --convert-to pdf:write_pdf_Export ' + file_ + ' .'
						os.system(cmd)
						cmd = 'lp ' + filePureName + '.pdf'
						break
		if boolSearch == False :
			print 'File is not existed'
			gotoxy(8,2)
			text("File is not existed")
		time.sleep(3)


if __name__ == '__main__':
	#t = threading.Thread(target=loop, name='LoopThread')
	#t.start()
	#t.join()
	main()

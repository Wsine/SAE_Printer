# -*- coding: utf-8 -*-

__author__ = 'Wsine'
__date__ = '2015-11-14'

import os
import time
import threading
import sys
from LCD_output import *
from termios import tcflush, TCIOFLUSH

def loop():
	while True:
		os.system('php getFile2.php')
		time.sleep(60)

def firstSearch(cur_dir, print_code):
	for root, dirs, files in os.walk(cur_dir):
		print '------------------- once------------------'
		for file_ in files:
			filePureName = file_.split('.')[0]
			if filePureName == print_code :
				return True
	return False

def main():
	# 获取当前脚本所在的路径
	cur_dir = os.getcwd()
	begin(0xbc) # contrast - may need tweaking for each display

	while True:
		# begin(0xbc)
		cls()
		gotoxy(2, 0)
		text("PLEASE INPUT")
		gotoxy(2, 1)
		text("YOUR")
		gotoxy(2, 2)
		text("PRINT CODE: ")
		tcflush(sys.stdin, TCIOFLUSH)
		print_code = raw_input("Please input your print code: ")
		if print_code == '147896325':
			break
		if firstSearch(cur_dir, print_code) == False:
			cls()
			gotoxy(2, 0)
			text("PRINT CODE")
			gotoxy(2, 1)
			text("IS")
			gotoxy(2, 2)
			text("CHECKING NOW")
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
					# begin(0xbc)
					cls()
					gotoxy(2,0)
					text("FILE IS")
					gotoxy(2,1)
					text("PRINTING NOW")
					print file_
					if file_.endswith('.pdf') :
						cmd = 'lp ' + file_
						# os.system(cmd)
						break
					else :
						cmd = 'libreoffice --invisible --convert-to pdf:write_pdf_Export ' + file_ + ' .'
						# os.system(cmd)
						cmd = 'lp ' + filePureName + '.pdf'
						# os.system(cmd)
						break
		if boolSearch == False :
			print 'File is not existed'
			# begin(0xbc)
			cls()
			gotoxy(2,0)
			text("FILE IS")
			gotoxy(2,1)
			text("NOT EXISTED")
		time.sleep(5)


if __name__ == '__main__':
	#t = threading.Thread(target=loop, name='LoopThread')
	#t.start()
	#t.join()
	main()

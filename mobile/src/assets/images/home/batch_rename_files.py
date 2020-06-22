# _*_ coding: utf-8 _*_
# @Time     :   2020/4/30 16:50
# @Author       vanwhebin

import os
import re

# file_dir = os.path.join(os.path.join(os.getcwd(), 'nanrentu'), 'xgmn')
# file_dir = os.getcwd()
# file_list = os.listdir(file_dir)
# ads = "(更多IT教程 微信a_xue1995)"
# ads = "(更多IT教程 微信352852792)"
ads = "拷贝"
# ads = "【更多IT教程 微信352852792】"
#ads = "(更多IT教程 微信107564881)"
# ads = "【更多资源＋微信：107564881】(更多IT教程 微信107564881)"


def execute(file_dir):
	file_list = os.listdir(file_dir)
	# print(file_list)
	for i in file_list:
		# print(i)
		if i.find(ads) != -1:
			os.rename(os.path.join(file_dir, i), os.path.join(file_dir, i.replace(ads, "-copy")))
			if os.path.isdir(os.path.join(file_dir, i)):
				execute(os.path.join(file_dir, i));



def main():
	file_dir = os.getcwd()
	execute(file_dir)


if __name__ == "__main__":
	main()
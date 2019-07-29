all:

uftesshell:
	 gcc uftesshell.c -o uftesshell -lreadline -lcurses
tcpServer:
	 gcc tcpServer.c -o tcpServer -lreadline 


all: monitor 

monitor: monitor.cpp
	g++ monitor.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp -o monitor

clean:
	rm monitor 

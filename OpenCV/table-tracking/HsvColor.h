#ifndef DataHolder_H
#define DataHolder_H
#include <string.h>

using namespace std;

class HsvColor {
    int low[3];
    int high[3];
    string name;

    public:
        HsvColor(string color){
            name = color;
        }

        void setLow(int h, int s, int v);
        void setHigh(int h, int s, int v);
        int getLow(int pos);
        int getHigh(int pos);
        string getColor();
};

void HsvColor::setLow(int h, int s, int v) {
    low[0] = h;
    low[1] = s;
    low[2] = v;
}

void HsvColor::setHigh(int h, int s, int v) {
    high[0] = h;
    high[1] = s;
    high[2] = v;
}

int HsvColor::getLow(int pos) {
    return low[pos];
}

int HsvColor::getHigh(int pos) {
    return high[pos];
}

string HsvColor::getColor() {
    return name;
}
#endif
//#include <iostream>
#include <fstream>
#include <jsoncpp/json/json.h>
#include "PersonData.h"
#include "DataHolder.h"

using namespace std;
using namespace Json;

int main() {
    ifstream ifs("data.json");
    Json::Reader reader;
    Json::Value obj;
    reader.parse(ifs, obj);     // Reader can also read strings
    const Value& edwin = obj["imageData"];
    cout << edwin.size() << endl;
    for (int i = 0; i < edwin.size(); i++) {
        int eid = edwin[i]["employeeId"].asInt();
        string name = edwin[i]["name"].asString();
        cout << "Adding: " << eid << " " << name << endl;
        PersonData person(eid, name);
        for (int j = 0; j < edwin[i]["data"].size(); j++) {
            list<int> tmpList;
            for (int k = 0; k < edwin[i]["data"][j].size(); k++)
            {
                int normalizedDataPoint = edwin[i]["data"][j][k].asInt();
                tmpList.push_back(normalizedDataPoint);
            }
            person.addToList(tmpList);
        }
        
        // cout << "size: " << edwin[i]["data"][0].size() << endl;
        // cout << edwin[i]["employeeId"];
        // cout << edwin[i]["data"][0];
    }

    
    //person.printList();
    
    //cout << "\n\n" << edwin;
    // cout << "Last name: " << obj["lastname"].asString() << endl;
    // cout << "First name: " << obj["firstname"].asString() << endl;
    return 0;
}
//#include <iostream>
//Compile with g++ profile.cpp -ljsoncpp -o [name]
#include "read.h"
#include "PersonData.h"
#include "DataHolder.h"

using namespace std;
using namespace Json;

void readLandmarkToMem() {
    ifstream ifs("data.json");
    Json::Reader reader;
    Json::Value obj;
    DataHolder holder;
    list<int> testList(68,30);
    list<int>::iterator test;
    // for (test = testList.begin(); test != testList.end(); test++) {
    //     cout << *test;
    // }
    
    vector<int> ids(3,-1); //ids.resize(3);
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
        
        holder.addToHolder(person);
        // cout << "size: " << edwin[i]["data"][0].size() << endl;
        // cout << edwin[i]["employeeId"];
        // cout << edwin[i]["data"][0];
    }
    cout << "printing list\n";
    //holder.printList();
    holder.compareData(testList, ids);
    cout << "\nTop three Ids: ";
    for (int i = 0; i < ids.size(); i++) {
        cout << ids[i] << " ";
    }
    cout << endl;

    //Data has now been loaded, DataHolder contains ALl persons in memory, PASS Test Data and return In order highest 
    //holder.compareData(testList, ids);
    
    //person.printList();
    
    //cout << "\n\n" << edwin;
    // cout << "Last name: " << obj["lastname"].asString() << endl;
    // cout << "First name: " << obj["firstname"].asString() << endl;
}
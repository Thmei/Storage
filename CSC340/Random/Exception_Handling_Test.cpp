#include <iostream>

using namespace std;

int main(){
	//try something where errors might occur
	try{
		int momAge = 50;
		int sonAge = 34;
		
		if(sonAge>momAge){
			//throw 
			//99 is just a variable 
			//99 here means mom is younger than son
			throw 99;
		}
	//what to do if there is an error	
	}catch(int x){
		cout << "Son can not be older than mom, ERROR NUMBER: " << x;
	}
	return 0;
}

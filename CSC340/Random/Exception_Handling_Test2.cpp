#include <iostream>

using namespace std;

int main(){
	try{
		int a;
		
		
		int b;
		cout << "Enter a number: \n";
		cin >> b;
		
		if(b == 0){
			throw 0;
		}
		
		cout << a/b << endl;
		
	}catch(int x){
		cout << "Cannot divide by " << x << endl;
	// catch(...) catches anything, not just specific thing	
		
	}
	
	
	return 0;
}

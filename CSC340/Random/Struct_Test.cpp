#include <iostream>

using namespace std;
//struct is like an array with multiple data types
//global struct for people
struct people{
//members go here
string name;	
int age;
string rank;
};

//function protoype/declarations
void print(people Police);
void constructor(people& Police, string name, int age, string rank);
int main(){
	//to use structs
	//set information for members for struct
	people Kougami = {
	"Kougami Shinya",
	28,
	"Enforcer"
	};
	
	//another way to set information for structs
	people Nobuchika;
	Nobuchika.name = "Nobuchika Ginoza";
	Nobuchika.age = 28;
	Nobuchika.rank = "Inspector";
	
	//example for the array struct 
	people Tsunemori;
	Tsunemori.name = "Tsunemori Akane";
	Tsunemori.age = 20;
	Tsunemori.rank = "Inspector"; 
	
	//example for array struct for function
	people Shimotsuka;
	Shimotsuka.age = 17;
	Shimotsuka.name = "Shimotsuka Mika";
	Shimotsuka.rank = "Bitch";
	
	//example for contructor function
	people Tomomi;
	
	//Using an array of structs
	people Police[15];
	Police[0] = Kougami;
	Police[1] = Nobuchika;
	Police[2] = Tsunemori;
	Police[3] = Shimotsuka;
	Police[4] = Tomomi;
	
	constructor(Tomomi,"Tomomi Masaoka", 57,"Enforcer");
	
	
	//example output for struct
	cout << "Name: " << Kougami.name << endl << "Age: " << Kougami.age << "\nRank: " << Kougami.rank << endl;
	cout << endl;
	cout << "Name: " << Nobuchika.name << endl << "Age: " << Nobuchika.age << "\nRank: " << Nobuchika.rank << endl;
	cout << endl;
	cout << "Name: " << Police[2].name << endl << "Age: " << Police[2].age << "\nRank: " << Police[2].rank << endl;
	cout << endl;
	print(Shimotsuka);
	cout << endl;
	print(Tomomi);
	
	return 0;
}

//function to print 
// ( struct name& array name)
void print(people Police)
{
cout << "Name: " << Police.name << endl << "Age: " << Police.age << "\nRank: " << Police.rank << endl;
	
}
//constructor method
//to initilize objects
//creating members with ease
void constructor(people& Police, string name, int age, string rank){
	Police.name = name;
	Police.age = age;
	Police.rank = rank;
}


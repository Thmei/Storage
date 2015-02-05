#include <iostream>
#include "account.h"

using namespace std;
int main() {
	acc a; // so i can call the "acc" class
	double  deposit,withdraw, amount = 1000.00; // set up variables and set how much money you start with
	cout << "You currently have $" << amount << " on you.\n";
	cout << "you currently have a balance of $" << a.getBalance() << " in your bank account\n";
	try{ //try block to try code
	cout << "Please enter an ammount to deposit:\n";
	cin >> deposit;
	a.deposit(deposit);
	
	cout << "You have chosen to deposit $" << deposit << " into your bank account\n";
	cout << "Your current bank account has $"<<a.getBalance() << endl;
	
	cout << "Please enter an ammount to withdraw:\n";
	cin >> withdraw;
	
	a.withdraw(withdraw);
	
	cout << "You have withdrawn $" << withdraw << " from your bank account\n5";
	cout << "you current bank account has $" << (a.getBalance()) << endl;
	}catch(exception & e){ //catch block if someone goes wrong in code
		cout << "Exception caught: "<< e.what() << endl;
	}
	
	return 0;
}

#ifndef ACCOUNT_H
#define ACCOUNT_H

#include <iostream>
#include <stdexcept>

// class for prototypes and variables that are global/public
using namespace std;
class acc{
	public:
		double balance = 500;
		
		double getBalance();
		double deposit(double amount);
		double withdraw(double amount);
};


// exception calss for if you try to deposit a negative ammount
class exception_Negative_Deposit: public exception{
	public:
		virtual const char* what() const throw(){
			return "ERROR! UNABLE TO HAVE NEGATIVE DEPOSIT!";
		}
};
// exception class for if you try to withdraw more tha nwhat you have
class exception_Overdraw: public exception{
	public:
		virtual const char* what() const throw(){
			return "ERROR! UNABLE TO OVERDRAW!";
		}
};
// exception class for if you try to deposit more than what you have
class exception_Not_Enough: public exception{
	public:
		virtual const char* what() const throw(){
			return "ERROR! UNABLE TO DEPOSIT MORE THAN WHAT YOU HAVE!";
		}
};
// exception class for if you try to withdraw a negative ammount
class exception_Negative_Withdraw: public exception{
	public:
		virtual const char* what() const throw(){
			return "ERROR! UNABLE TO HAVE NEGATIVE WITHDRAWAL";
		}
};



#endif



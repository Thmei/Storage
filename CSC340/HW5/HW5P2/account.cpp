#include "account.h"

// returns current balance
double acc::getBalance()
	{
		return balance;
	}
// returns new balance or exception if negative or over the limit
double acc::deposit(double amount)
	{
		exception_Negative_Deposit nD;
		exception_Not_Enough nd;
			
		if (amount < 0){
			throw nD;
		}
		if (amount > 1000){
			throw nd;
		}
		balance += amount;
		return balance;
	}
		
	
// returns new balance or exception if negative or over the limit
double acc::withdraw(double amount)
	{
		exception_Negative_Withdraw wD;
		exception_Overdraw oD;
			
		if (amount < 0){
			throw wD;
		}
		if (amount > balance){
			throw oD;
		}
		balance -= amount;
		return balance;
	}

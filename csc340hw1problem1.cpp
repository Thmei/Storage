//Thomas X Mei  CSC 340  911647469

#include <iostream>
#include <cmath>
#include <cstdlib>
#include <cstring>
using namespace std;

string text;
int numOfWords = 0; 

// struct to hold members of word and count
struct word{
 string word;
 int count;
};
int getFreqLetter(string a);
int countWordFreq(string a);
int main (){
	//get string of text from user and store it 
	cout << "Enter some text: " << endl;
	getline(cin, text);

	int numofChars = 0;
	cout << "Length of text : "<< text.length() << endl ;
	cout << endl;
	getFreqLetter(text);
	countWordFreq(text);
	return 0;
}
int getFreqLetter(string a){
	int letter [26] = {0};
	int mostFreqLetter = 97;
	int freq = letter[0];
	
	for(int i = 0; i < a.length(); i++)
	{
		//chagnes from upper to lower case
	if(a[i] >= 65 && a[i] <= 90)
				a[i] += 32;
		//add to the letter count
	if(a[i] >= 97 && a[i] <= 122)
				letter[a[i]-97]++;
	}
		for(int i = 0; i < 26; i++)
	{
		if(letter[i] > freq)
		{
			mostFreqLetter = i;
			freq = letter[i];
		}
	}
		// alphabet index is the letter, value is the letter count.
	for(int i = 0; i < 26; i++)
	{
		cout << "Letter "<< (char)(i+97)<< " with frequency of " <<letter[i] << " " <<endl;
	}
	
	cout << "The most frequent letter is '" << (char)(mostFreqLetter+97) << "' with a count of " <<  freq << endl;
}
int countWordFreq(string a){
	word words[100];
	//int numOfWords = 0; 
	//initializes the word struct
    for(int i = 0; i < 100; i++)
	{
		words[i].word = "";
		words[i].count = 0;
	}
	//makes upper cases into lower case for case insensitive
    for(int i = 0; i < a.length(); i++)
	{
		if(a[i] >= 65 && a[i] <= 90)
			a[i] += 32;
	}
		for(int i = 0; i < a.length(); i++)
	{
		//punctuation check for word count
		if(a[i]!=' ' && a[i]!='.' && a[i]!='!' && a[i]!='?' && a[i]!=';' && a[i]!='"' ) 
		{
			words[numOfWords].word += a[i];
		}
		else if(a[i] == ' ' && a[i+1] >= 97 && a[i+1] <=122)
		{
			numOfWords++;
		}
	}
	for(int i = 0; i <= numOfWords; i++)
	{
		words[i].count++;
	}
	for(int i = 0; i <= numOfWords; i++)
	{
		for(int j = i+1; j <= numOfWords;j++)
		{
			// checks if the strings are equal or not
			if(!words[i].word.compare(words[j].word))
			{
				words[j].count++; 
				words[i].count = 0;
        	}
		}
	}

	cout << "Word\t\tFrequency"<<endl;
	for(int i = 0; i <= numOfWords; i++)
	{
			if(words[i].count != 0)
			cout <<"Word "<< ": "<< words[i].word << "\t\t" << words[i].count <<endl;
	}

}

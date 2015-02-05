#include <iostream>
#include <string>
#include <vector>
using namespace std;

string paragraph = "";
int numOfWords = 0;

void getFreqLetter(string s);
void countWordFreq(string s);

struct wordCount
{
	string word;
	int count;
};

int main()
{
	cout << "Enter paragraph: " << endl;
	getline(cin, paragraph);

	for(int i = 0; i < paragraph.length(); i++ ) 
	{
		//Consider spaces delimit words
		if(paragraph[i] == ' ')
		{
			numOfWords++;
		}
	}

	// remove space at end of string in case
	if(paragraph[paragraph.length()-1] == ' ')
	{
		numOfWords--;
	}
	
	// word count = # of spaces + 1
	numOfWords++;

	if(paragraph.length() == 0)
		numOfWords = 0;
	
	if(numOfWords > 100 || numOfWords < 1)
	{
		cout << "Invalid word count. Must be 1 to 100 word(s).(inclusive)" << endl;
	}	
	else
	{
		cout << "There are "<< numOfWords << " words." << endl;
		getFreqLetter(paragraph);
		countWordFreq(paragraph);
	}
	return 0;
}

void getFreqLetter(string s)
{
	int alphabet [26] = {0};
	int mostFreqLetter = 97;
	int letterFrequency = alphabet[0];
	
	for(int i = 0; i < s.length(); i++)
	{
		//convert all uppercase to lowercase
		if(s[i] >= 65 && s[i] <= 90)
			s[i] += 32;
		//add to respective letter count
		if(s[i] >= 97 && s[i] <= 122)
			alphabet[s[i]-97]++;
		
	}
	
	for(int i = 0; i < 26; i++)
	{
		if(alphabet[i] > letterFrequency)
		{
			mostFreqLetter = i;
			letterFrequency = alphabet[i];
		}
	}
	
	cout << "Character\tFrequency" <<endl;
	// alphabet[] index is the letter, value is the letter count.
	for(int i = 0; i < 26; i++)
	{
		cout << (char)(i+97)<< "\t\t" <<alphabet[i] << " " <<endl;
	}
	
	cout << "The most frequent letter is '" << (char)(mostFreqLetter+97) << "' with a count of " <<  letterFrequency << "\n" <<endl;
}

void countWordFreq(string s)
{
	wordCount words[100];
	int numOfWords = 0; //will be actually 1 less than num of words so condition should be <= in arrays
	
	//initialize struct
    for(int i = 0; i < 100; i++)
	{
		words[i].word = "";
		words[i].count = 0;
	}
	//convert all uppercase to lowercase
    for(int i = 0; i < s.length(); i++)
	{
		if(s[i] >= 65 && s[i] <= 90)
			s[i] += 32;
	}
	
	for(int i = 0; i < s.length(); i++)
	{
		if(s[i]!=' ' && s[i]!='.' && s[i]!='!' && s[i]!='?' && s[i]!=';' && s[i]!='"' ) //covers most of the important punctuation.
		{
			words[numOfWords].word += s[i];
		}
		else if(s[i] == ' ' && s[i+1] >= 97 && s[i+1] <=122)
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
			if(!words[i].word.compare(words[j].word))//if strings are equal
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
			cout <<words[i].word << "\t\t" << words[i].count <<endl;

	}

}



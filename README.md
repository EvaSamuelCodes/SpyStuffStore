# SpyStuffStore

## What are the roots of this very odd thing you've posted, Evalynn?
So, a long time ago, there was this charming little .net based shopping cart demo called IBuySpy that was put out by Microsoft. I wanna say (without dating myself), that the first one, before the name was repurposed for a sharepoint portal, or other such nonsense, that the one I liked came out circa... somewhere between 2000 and 2003. 

Anyway, the thing was adorable. The premise relied on having these seemingly mundane objects that were actually... implements of death and mass destruction. I literally laughed my ass off. I was experimenting with C# at the time, and the humor of the thing really helped it all sink in. It was new to everyone. Remember, this was the very first production version of .Net.

Well, I got this idea in my head that I was going to port the whole thing to php and mysql. So I wrote what was actually a fairly faithful port of it in php 4. Doing as best I could with basic objects, lack of inheritance, and so on. 

Honestly, it was a horrible mess, and I'm not upset at all that I completely lost the code two marriages and 25 laptops ago. But what I did keep was the data. Well, most of it. For years, I used it as filler data for all kinds of stuff. E-commerce systems, blogs, you name it. 

The structures are mostly gone at this point, almost 20 years later, and I don't have the original images anymore, but I do have the descriptions, which I used lovingly in this challenge demo that I wrote over the course of weekend in late 2018, for a company that wanted to see what my php code looked like at the time.

And that is this, the very odd thing I've just posted.

## What's it do?

Basically just your average, every day, totally charming shopping cart demo. It's basic, but functional. And I intentionally made some architecture decisions in writing this for the purpose of being talked about in an interview situation. 

***Some caveats:***
* Checkout doesn't quite work
* bear in mind that I wrote this in a weekend
* understand that I didn't have time to finish it
* also understand that there are things I wanted to implement that were part of the spec, like sales tax calculation, which I didn't have time to get to before the monday morning deadline.
* I also wrote one that makes pizzas, but I can't find it. I should *really* use github to store these more often. I know, I know, been lax.

### Sweet, how do I install it?
* It needs at least some civilized version of php, version 7 or better. 
* In the SQL directory, there's an SQL file. Create the database and run it.
* Adjust your config.php in the root of the file system to the correct database variables. Don't worry, knowing the usernames and passwords I use on throwaway server images won't harm or help anyone. :)
* Make sure rewrite is enabled
* Enjoy.

#### Are there any dependencies?
Yes, this happy little web app uses a particular version of the Pharse library for easy Dom parsing. Fear not, I've included it.
<h1>Example of th data generator for User table</h1>

<h2>What is this?</h2>
<p>In the software development process is often a need to test data. Anyway,
the programmer needs to make sure that the program will work with the actual amount of data before it will give to the customer. In the case when the amount of data does not matter it will not cause serious problems, but what if that is supposed database table can contain more than 1000000 and more records?  How to quickly and easily create test data for this table? This requires a flexible and simple tool capable of quickly generate test data in a useful format for import to the database. The solution to this issue is shown by the example of the data to for the user table</p>

<h2>What was used?</h2>
<ol>
<li>PHP5 as console applicaion</li>
<li>Zend_Console_Getopt class for collect of the options</li>
<li>Scabo_Heap - own library for generate random data</li>
</ol>

<h2>Architecture of the Scabo_Heap</h2>
<p>For maximum flexibility, the application is divided into four parts:</p>
<ol>
<li>Settings source</li>
<li>Settings reader</li>
<li>Result writer</li>
<li>Result target</li>
</ol>

<h3>Settings source</h3>
<p>Provides configuration information for Settings Reader. It may be anything - file, string, etc.</p>

<h3>Settings reader</h3>
<p>Reads settings data from the source as some format. So you can implement reader for any format</p>

<h3>Result writer</h3>
<p>Converts generated data to the  some format and move it to the target. Also you can implement writer to any format.</p>

<h3>Result target</h3>
<p>Writes generated data to somewhere. Usually, it's file, but you can implement any target - directory, string, etc.</p>

<h2>Example</h2>
<p>Please, put Zend Framework in library directory</p>
<h3>Structure of data</h3>
<ul>
<li>id - increment - unique identifier</li>
<li>name - string - first name</li>
<li>surname - string - last name</li>
<li>dob - date - birthday</li>
<li>sex - enum(male of female) - gender</li>
<li>country_id - int - foreign key on country table</li>
<li>desc - string - description</li>
<li>active - bool - TRUE if record active, otherwise FALSE</li>
</ul>

<h3>Example of the settings file</h3>
<p>Please, see settings.xml in the root</p>
</div>

<h3>Console command</h3>
<div class="highlight">
<pre>
php run.php --settings-file=./settings.xml --settings-format=xml --output-dir=./output --output-format=csv
</pre>
</div>
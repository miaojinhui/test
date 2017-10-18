<?php
php 运行在服务器端的动态弱类型脚本语言
	(语言类型: 动态类型 静态类型 强类型 弱类型
		动|静 变量类型是否在编译时确定
		强|弱 类型自动转换
	)

基本语法
	php 代码都要在	
	/**
	 * <?php ?>
	 * ...
	 */
	变量前必须加 $

标识符
	命名 变量, 常量, 函数, 类, 方法...
	任意长度, 由数字字符下划线组成, 不能以数字开头, 区分大小写(函数名例外), 变量名可以和函数名相同(不推荐)

数据类型
	布尔类型
	字符串类型
	整数类型
		整数
		浮点数
	数组类型
	对象类型
	资源类型 	eg: 数据库, 文件(基本上不能直接操作资源类型数据,通常由函数返回生成,用作参数传给其他函数)
	空类型

常量与变量
	(
		数据类型 $name = value;
		$name = value;
	)
	常量 
		一旦设置无法改变, 全局可见, 通常大写, 常量只能包含标量数据(boolean, integer, float, string)可以定义 resource 常量, 但不建议
		define
		const(5.3 之后)
			eg:
				define("PORT", 9527);
				echo PORT;
				const PI = 3.14;
				echo PI;
		define 与 const 的区别
			1) const 可在类中使用, define 不可以
			2) const 定义的常量大小写敏感, define 可以通过第三个参数是否大小写敏感(true 大小写不敏感)

		php 本身预定义了很多常量	
			phpinfo() 获取 PHP 预定义常量和变量的列表, 以及其他信息
			eg: 布尔，整数，浮点数，字符串
	变量		
		超级全局变量, 全局可见
			定义方式：
				$GLOBALS eg: $GLOBALS temp;

			$_SERVER 	服务器环境变量
			$_GET 		通过 get 方式传递给脚本的变量数组
			$_POST
			$_REQUEST
			$_COOKIE 	cookie 变量数组
			$_SESSION 	会话变量数组
			$_FILES 	与文件相关的变量数组
			$_ENV 		环境变量
数组 同一类型的数据的集合(可能非同一数据类型)
	定义数组：
		$arr = [1, 2, 3];
		$arr = array(1 => 'aaa', 2 => 'bbb');
	索引数组, 关联数组, 混合数组, 多维数组
	(索引数组与关联数组没有明显的区别, 在同一个数组中, 可以使用整型, 字符串作为索引)
		eg：
			$arr = array('a', 'b', 'c');
			$arr = array(1, 2, 3);
			$arr = array(1, 'a');
			$arr = array(
				"a" => array(1, 2, 3),
				"b" => array(1, 2, 3),
				"c" => array(1, 2, 3),
			);
	遍历数组：
		foreach($arrs as $arr)
		{
			echo $arr;
		}
		foreach($arrs as $key => $val)
		{
			echo $key . '+' . $val
		}
		$len = count($arr);
		for($i = 0; $i < $len; $i++)
		{
			echo $arr[$i];
		}
	数组相关的函数：
		sizeof($arr) count($arr) 返回数组的长度

		compact()	函数创建包含变量名和它们的值的数组

		sort($arr)		根据 value 进行升序排序, 原先 key 丢失
		rsort($arr)  	根据 value 进行降序排序, 原先 key 丢失
		asort($arr) 	根据 value 进行升序排序, 原先 key 保留
		arsort($arr) 	根据 value 进行降序排序, 原先 key 保留
		ksort($arr) 	根据 key 进行升序排序, 原先 value 保留
		krsort($arr) 	根据 key 进行降序排序, 原先 value 保留
			eg：			
				$grade = ['aaa' => 100, 'bbb' => 90, 'ccc' => 95];
				sort($grade);
				var_dump($grade);

				array (size=3)
					0 => int 90
					1 => int 95
					2 => int 100	
		shuffle() 随机排序, 数组元素打乱, 原先 key 丢失
			eg:
				$arr = [1, 2, 3];
				shuffle($arr);//返回 ture or false
				var_dump($arr);//原数组顺序已经变化
		array_reverse($arr, $flag) 函数以相反的元素顺序返回数组。
			如果第二个参数指定为 true，则元素的键名保持不变，否则键名将丢失。

		current($arr) 返回数组中当前元素的值 value (数组中有一个内部指针指向当前, 初始指向数组中的第一个元素)
		key($arr) 返回数组中当前元素的值 key
		end($arr) 返回数组中最后一个元素的值 value

		array_keys($arr)	返回由数组中的键名组成 de 新数组
		array_values($arr) 	返回由数组中的键值组成 de 新数组

		is_array($arr) 	判断变量是否是数组
		in_array($temp, $arr) 判断数组 $arr 中是否有 键值 $temp, 存在返回 true ... 

		array_diff($arr, $arr1)			返回 $arr, $arr1 的差值组成的数组

		array_key_exists($temp, $arr)   判断数组 $arr 中是否有 键名$temp, 存在返回 true ... 
		array_search($temp, $arr) 		在数组 $arr 中搜索 键值$temp, 并返回对应的键名
		array_unique($arr) 				函数移除数组中的重复的值, 并返回结果数组（保留键名）
			$arr = [
		        1   => 'a',
		        2   => 'b',
		        3   => 'a',
		    ];
		    $temp = array_unique($arr);
		    var_dump($temp);

		    array (size=2)
		      1 => string 'a' (length=1)
		      2 => string 'b' (length=1)
		array_slice($arr, $start, $length, $preserve) 	根据条件截取数据（$preserve 是否保留键名）
		array_splice   移除元素!!!
			待补充
		array_push($arr, $value1, $value2...) 			向数组中添加若干个元素, 返回新数组的长度
		array_merge($arr1, $arr2, $arr3...) 			多个数据合并成一个新数组(保留键名)
		array_flip($arr)								$key 与 $value 翻转后返回
			若 $value 不是字符串或整数则报错
		array_map('functionName', $arr)					对数组中的每一个元素执行操作, 返回经过指定函数处理的元素组成的新数组
			$data = array_map('intval', ['1', '2', '3']);
			var_dump($data);

			array (size=3)
			  0 => int 1
			  1 => int 2
			  2 => int 3
		array_count_values($arr)	统计数组中元素出现的次数, 返回新数组 元素 value => 出现的次数
			$arr = ['a', 'b', 'c', 'a'];
			$temp = array_count_values($arr);
			var_dump($temp);

			array (size=3)
				'a' => int 2
				'b' => int 1
				'c' => int 1
		range(min, max, [step]) 创建一个连续数组
			eg:
				$arr = range(0, 10 , 3);
				var_dump($arr);

				array (size=4)
					0 => int 0
					1 => int 3
					2 => int 6
					3 => int 9
		list() 在一次操作中给一组变量赋值
			eg:
				$arr = array("Dog", "Cat", "Horse");
				list($a, $b, $c) = $arr;
				echo "I have several animals, a $a, a $b and a $c.";


		array_merge($a, $b) 与 $a + $b 的区别
		key 为 string 时
			$a + $b 	
				key 相同时 保留第一次出现的元素 抛弃后出现的
			array_merge($a + $b)
				key 相同时 后出现的元素覆盖前面出现的
		key 为 数字 时
			$a + $b 	
				key 相同时 保留第一次出现的元素 抛弃后出现的
			array_merge($a + $b)
				不会覆盖

字符串
	定义字符串：
		''	单引号内容直接输出
		""	双引号内容编译后再输出

	字符串相关的函数：
		strrev($str)	字符串翻转
			eg：
				$str = 'mjh';
				$str1 = strrev($str);
				var_dump($str);
  
				'mjh'
				'hjm'
		strlen($str)	返回字符串长度

		strtolower($str) 字符串转为小写
		strtoupper($str) 字符串转为大写

		trim($str), ltrim($str), rtrim($str) 去除空格

		substr($str, $start, $length) 截取字符串
		strpos($str, $search) 返回 search 在 str 中第一次出现的位置
		str_replace($search, $replace, $str) 在字符串 str 中查找 search 用 replace 替换
			eg:
				echo str_replace("world", "mjh", "Hello world!"); 

				Hello mjh!
		str_split($str, [length]) 将字符串分割为数组(length 指定数组中每个元素的长度, 默认为1)	
			eg: 
				$temp = str_split('mjh'); 
				var_dump($temp);

				array (size=3)
					0 => string 'm' (length=1)
					1 => string 'j' (length=1)
					2 => string 'h' (length=1)
		strcmp($str1, $str2)	函数比较两个字符串
		strcasecmp($str1, $str2) 比较两个字符串, 不区分大小写
			返回值:
				0		两个字符串相等
				< 0 	$str1 小于 $str2
				> 0 	$str1 大于    $str2

数组与字符串之间的转换
	explode($temp, $str); 按 temp 将字符串 str 分割为数组
		eg：
			$str = 'Hello World';
			$arr = explode(' ', $str);
			var_dump($arr);

			array (size=2)
			  0 => string 'Hello' (length=5)
			  1 => string 'World' (length=5)
	implode($temp, $arr); 按 temp 将数组 arr 组合成字符串
		eg：
			$arr = ['a', 'b', 'c'];
			$str = implode('+', $arr);
			var_dump($str);	

			'a+b+c'
			
JSON 相关
	json_decode($json, $flag)	接受一个 JSON 编码的字符串并且把它转换为 PHP 变量
		$json 待解码的 json   string 格式的字符串
		$flag 该参数为 true, 返回 array   该参数为 false, 返回 object
	json_encode($value)		返回 value 值的 JSON 形式

	JSON.parse()和JSON.stringify()

文件操作
	文件读取的相关函数
		file_get_contents(filename) 获取文件内容转化为字符串
		readfile() 参数：文件名。读取一个文件，写入到输出缓冲
		eg:
			echo readfile('demo.txt');//demo.txt 在当前目录下
		fopen() 第一个参数文件名, 第二个参数打开文件的模式	打开文件, 返回文件的句柄 (使用之后, 文件指针在文件末尾)
		eg:
			$file = fopen('demo.txt', 'r') or die('unable open file!');
    		echo fread($file, filesize('demo.txt'));
    		fclose($file);
		fread() 第一个参数文件句柄, 第二个参数读取的字节数	读取文件
		fgets() 参数：文件句柄	读取文件指针所在的行(使用之后, 文件指针下移一行)
		fgetc() 参数：文件句柄 	读取文件指针所在的字符(使用之后, 文件指针后移一个字符)
		feof() 	参数：文件句柄 	判断文件指针是否在文件末尾
		filesize()	参数：文件名 	文件的字节数
		fclose()	参数：文件句柄 	关闭文件
		eg:
			$file = fopen('demo.txt', 'r');
	    	echo 'filesize:'. filesize('demo.txt') . '<br/>';
	    	echo fgets($file) . '<br/>';
		    while(!feof($file))
		    {
		        echo fgetc($file) . "&nbsp;";
		    }
		    fclose($file);
	文件写入的相关函数：
		file_put_contents(file, data, mode) 将字符串存入文件中	
			mode: FILE_APPEND 文件累加存储
		fopen()    获取文件句柄 注意打开文件的模式
		fwrite()   第一个参数文件句柄, 第二个参数写入的信息 写入文件(覆盖文件中原先的信息)
		eg:
		    $file = fopen('demo.txt', 'w');
		    $str = "lff\n";
		    fwrite($file, $str);
		    $str = "mjh\n";
		    fwrite($file, $str);
		    fclose($file);

			demo.txt 中为：
				lff
				mjh

uniqid() 函数基于以微秒计的当前时间 生成一个唯一的 ID			

时间日期
	date_default_timezone_get()//获取当前使用的时区
	date_default_timezone_set('PRC')//设置中国时区
	time() 没有参数, 返回当前日期的时间戳
	date() 第一个是日期格式, 第二个时间戳(默认当前时间戳) 根据给定时间戳返回格式化的字符串
		eg:
			echo date('Y-m-d H:i:s'); 
			echo date('l');
	strtotime() 将合理字符串的时间日期转化为时间戳
		eg:
			echo strtotime('+1 day');
			echo strtotime('now');
			echo strtotime("last Monday");
	mktime(hour, minute, second, month, day, year) 返回指定日期的时间戳 
		eg:
			echo mktime(1, 2, 3, 4, 5, 2006);
	checkdate(month, day, year) 检验时间日期是否合法	
    microtime(flag) 函数返回当前 Unix 时间戳的微秒数		


	计算两个日期之间的时间差
		通过 mktime() 获取两个时间的时间戳的差值
		通过 strtotime() ...
		eg:
			$temp = strtotime('+1 day') - strtotime('now');
    		echo $temp/3600;

数据库
	php 中操作数据库的函数:
		$link = @mysql_connect($hostname, $user, $password) or die('error'); 
			获取数据库连接
			连接成功, 返回连接标识符, 否则返回 false
			(@抵制错误消息)
		mysql_select_db('info') 		选择数据库
		mysql_query('set names utf8') 	设置数据库字符集
			
		$sql = 'SELECT * FROM PERSON';	
		$query = mysql_query($sql) 执行sql语句
			
			insert操作: mysql_insert_id() 返回设置 id
			select操作: 结果集的资源标识符(地址)

			循环所有数据
				while($data = mysql_fetch_object($query)){
					var_dump($data);
				}

		mysql_affected_rows()	记录上一次操作影响的行数
		mysql_num_rows($query)	获取结果集中记录的数目
					
		以下四种方法默认都只要获取第一条数据
			mysql_fetch_row($query) 		每次返回结果集的一个一维索引数组	
			mysql_fetch_assoc($query) 		每次返回结果集的一个一维关联数组
			mysql_fetch_array($query, temp) 每次返回结果集的一个混合数组(索引, 关联)（temp 设置具体的数据格式）	
			mysql_fetch_object($query) 		将结果集中的一条数据以对象的形式返回
		
			
		mysql_num_fields($query) 	返回结果集中字段的数		
		mysql_result($query, x, y) 	获取结果集中指定行与列的值
			eg:
				mysql_result($query, 1, 1);//获取第 2 行第 2 个列的值
				mysql_result($query, 1, 'name');//获取第 2 行 name 字段的值

		mysql_close($link) 	断开数据库连接
			 
		mysql_error() 	返回上一个错误消息
		mysql_errno() 	返回上一个错误消息的编号		

数学函数
	abs() 	返回绝对值
	round() 四舍五入
	ceil()	向上取整
	rand(min, max) 返回随机整数, 无参数则返回 0 与 RAND_MAX 之间的随机整数
	mt_rand(min, max)	mt_rand() 比 rand() 方法快四倍, 而且生成的随机数比 rand() 生成的伪随机数更无规律
	max()
	min()

正则表达式相关
	preg_match($pattern, $subject) pattern正则,subject搜索字符串。返回区配的次数，0 或 1 。区配到之后就停止
		eg:preg_match('/he/', 'hellow');
	preg_replace($pattern, $replacement, $subject) pattern正则,replacement替换内容,subject搜索字符串 查找指定字符串并替换!
		eg:preg_replace('/he/', '', 'hellow');
	preg_match_all($pattern, $subject, $matches) ?

面向对象
	eg:
		class Person
		{
			// 属性
			public $name;
			public $age;
			// 方法
			public function run()
			{
				echo $this->name.' run!';
			}
		}
		$person=new Person();
		echo $person->name='mjh';
		echo $person->name;
		$person->run();

	类是对象的抽象,对象是类的具体化
	面向对象三大特征:封装继承多态
		封装 通过访问权限修饰符实现
			public 最大访问权限
			protected 当前类及其子类可以访问
			private 仅类可以访问
		继承 extends
			php 单继承, 通过继承可以获取父类除私有成员变量/方法之外的所有变量/方法
		多态 implements
			php中多态的效果不是很明显,
			多态指的同一类对象在运行时的具体化
			PHP语言是弱类型的,实现多态更加简单,灵活
			类型转换不是多态
			PHP中父类和子类看做继父和继子的关系,存在继承关系但是不存在血缘关系,子类无法向上转型为父类,从而失去了最基本的特征
			多态的本质是if...else,只不过实现的层级不同
			eg:

			    interface employee
			    {
			        public function working();
			    }
			    class Teacher implements employee
			    {
			        public function working()
			        {
			            echo "teacing";
			        }
			    }
			    class Coder implements employee
			    {
			        public function working()
			        {
			            echo "coding";
			        }
			    }
			    function doprint(employee $e)
			    {
			        $e->working();
			    }
			    // 实现了接口的特征
			    // 接口:同一类型,不同结果
			    $t=new teacher();
			    $c=new Coder();
			    doprint($t);
			    doprint($c);
	重写
		子类重写父类的方法
	关键字	
		this	指向当前对象
			获取非静态属性和方法
		self 	指向当前类
			在类的内部调用静态方法静态属性时使用
		parent  指向当前类的父类
			parent::__construct(); 调用父类构造方法

		static 
			修饰属性/方法 当前属性/方法属于类本身,可以通过类(无需创建对象)来调用(self)
		final
			修饰方法,无法被子类重写
		abstract
			修饰类,方法
			若一个类为抽象类,在该类中至少有一个抽象方法
			抽象方法只有方法体
			若继承抽象方法,则需实现抽象方法,否则该类也需定义为抽象类!
		interface 
			定义接口
			接口中的方法都为抽象方法

	魔术方法()
		__construct() 构造方法,在对象被创建时自动调用
			在PHP中只允许存在一个构造方法
				PHP中的重载指的是动态的创建类属性和方法,__get()和__set()都可以为归到重载中
		__destruct() 析构方法,在对象被销毁前自动调用(不能主动调用,不清楚对象何时被销毁)
		__toString() 在对象被输出时调用
			可以定制输出对象的格式
		__get() 在对象试图调用不存在或不可见的属性时,自动调用
		__set() 在对象试图给不存在或不可见的属性赋值时,自动调用
		__call() 在对象试图调用不存在或不可见的方法时,自动调用
		__sleep(),__wakeup()
			在对象串行化的时,调用__sleep()方法来完成一些睡前的事情
			而在重新醒来时,即由二进制串重新组成一个对象的时候,则会自动调用__wakeup()做对象醒来要做的事情

		__autoload() 重要!!! PHP MVC框架的核心!!! 实现类文件的自动加载!
			实际开发不会把所有的类都写在同一个文件中,但是每次使用时都调用不现实
			__autoload() 当调用当前页面不存在的类时,会自动加载相应的类!
			eg:

				function __autoload($classname)
				{
					require_once $classname . '.php';
				}
				//MyClass1类不存在时，自动调用__autoload()函数，传入参数”MyClass1”
				$obj = new MyClass1();
				//MyClass2类不存在时，自动调用__autoload()函数，传入参数”MyClass2”
				$obj2 = new MyClass2();

	对象的串行化(序列化)
		对象序列化实行的条件:
			1) 一个对象在网络中传播时需要将其串行化
			2) 将对象写入文件或数据库
		serialize() 函数的参数为对象名，返回值为一个字符串	
		unserialize() 函数反序列化对象
		eg:

			class Person{}
			$person=new Person();
			$str=serialize($person);
			echo $str;
			$temp=unserialize($str);
			echo $temp;

	组合关系
		在一个类的对象中的一个变量为对象形式


	Trait
		Trait使单继承模式的语言获得多继承的灵活,又可以避免多继承带来的问题
		eg:
			trait Driver{
		        public $carName="bmw";
		        public function driving(){
		            echo "driving\n";
		        }
		    }
		    class Person{
		        public function eat(){
		            echo "eat\n";
		        }
		    }
		    class Student extends Person{
		        use Driver;
		        public function study(){
		            echo "study\n";
		        }
		    }
		    $student=new Student();
		    $student->study();
		    $student->eat();
		    $student->driving();
		    echo $student->carName;
		    // (如果是组合,在需要实例化.所以在这里是 体现为 多继承)









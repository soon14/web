<?php
!defined('IN_LOT')&&die('Access Denied');
include(IN_LOT.'include/class/lunar.class.php');
/* 生肖年信息 */
$LOT['_temp'] = array();
$LOT['_temp'][0] = array(
    '鼠',
    '牛',
    '虎',
    '兔',
    '龙',
    '蛇',
    '马',
    '羊',
    '猴',
    '鸡',
    '狗',
    '猪',
);
$LOT['_temp'][1] = array(
    array(1, 13, 25, 37, 49),
    array(2, 14, 26, 38),
    array(3, 15, 27, 39),
    array(4, 16, 28, 40),
    array(5, 17, 29, 41),
    array(6, 18, 30, 42),
    array(7, 19, 31, 43),
    array(8, 20, 32, 44),
    array(9, 21, 33, 45),
    array(10, 22, 34, 46),
    array(11, 23, 35, 47),
    array(12, 24, 36, 48),
);
$LOT['animal'] = array();
/* 加载农历年份 */
$_lunar = new Lunar();
$_ldate = $_lunar->convertSolarToLunar(date('Y'), date('m'), date('d'));
unset($_lunar);
foreach($LOT['_temp'][0] as $key=>$val){
    $key = fmod($_ldate[0]-$key+8, 12);
    $LOT['animal'][$val] = $LOT['_temp'][1][$key];
}
unset($LOT['_temp']); // 释放临时信息
?>
            <div class="tab-colored-bd hide">
                <div class="typo">
                    <h3>游戏简介</h3>
                    <ul>
                        <li>开奖时间：7*24小时（北京时间凌晨00:00为前一天最后一期开奖时间）</li>
                        <li>开奖频率：90秒/期</li>
                        <li>开奖次数：960期/天</li>
                    </ul>
                    <h3>游戏玩法</h3>
                    <ol>
                        <li>以下所有投注皆含本金。</li>
                        <li>两面（指大、小、单、双）。</li>
                        <li>特别号码：香港彩公司当期开出的最后一码为特码；特码大小：开出之特码大于或等于25为特码大，小于或等于24为特码小；特码单双：特码为双数叫特双，如2、18；特码为单数叫特单，如17、33。</li>
                        <li>特码大小：开出之特码大于或等于25为特码大，小于或等于24为特码小，49为和；</li>
                        <li>特码单双：特码为偶数叫特双，为奇数叫特单，49为和</li>
                        <li>特码波色：指开出之特码所属的颜色</li>
                        <li>特码尾数大小：特尾小：开出之特码尾数（0-4），特尾大：开出之特码尾数（5-9），49号为和局。</li>
                        <li>过关：任选2-8个号码为一投注组合，其赔率为所选号码当时赔率的总乘积。投注组合所选号码必须全中才视为中奖。当开奖结果中某一号码为49时，其单双大小为和，赔率以1计算，波色为绿波。如正1为49，正1小-正1红为不中奖，正1大-正1单为和局，正1大-正1绿为中绿波。</li>
                        <li>正码：香港彩公司当期开出之前6个号码叫正码。第一时间出来的叫正码1，依次叫正码2、正码3……正码6，不以大小排序。</li>
                        <li>正码尾大小：总尾大：总分尾数（5-9），总尾小：总分尾数（0-4）。 </li>
                        <li>龙虎：在7个球中：第1个的号码大于第7个球的号码叫龙；反之，第7个球的号码大于第1个球的号码叫虎。 </li>
                        <li>总分大小：所有七个开奖号码的分数总和大于或等于175为总分大；分数总和小于或等于174为总分小。如开奖号码为01、07、15、29、38、46、24，分数总和是160，为总分小。</li>
                        <li>总分单双：所有七个开奖号码的分数总和是单数叫总分单(总单)，如分数总和是103、193；分数总和是双数叫总分双(总双)，如分数总和是108、160。</li>
                        <li>正码1-6：正码1、正码2、正码3、正码4、正码5、正码6的大小单双和特别号码的大小单双规则相同，如正码1为25，则正码1为大，为单；正码2为4，则正码2为小，为双；号码49，则为和。</li>
                        <li>正特：正1特、正2特、正3特、正4特、正5特、正6特:指下注的正码特与现场滚波开出之正码其开奖顺序及开奖号码相同，视为中奖，例如：现场开奖第三个正码为29号，下注第三个正码特为29则视为中奖，其它号码视为不中奖，其他正特项目依此类推。</li>
                        <li>正特尾数大小：正1特、正2特、正3特、正4特、正5特、正6特的尾数大小:若正码尾数开出（0-4）为尾小，开出号码是第一球，则为正1特尾小；若正码尾数开出（5-9）为尾大，开出号码是第二球，则为正2特尾大；下注与其对应的号码相同，则为中奖，其余为不中奖，如：正1特开出为32，下注为正1码尾大，则不中；开出正码号码为49则为和，不计算结果。</li>
                        <li>特码分段：49个号码分为5段，（1-10）、（11-20）、（21-30）、（31-40）、（41-49），下注的分段与开出特码对应的段相同，为中奖；其余为不中；如：特码是5，下注分段是1段，中奖。</li>
                        <li>特码合数单双：指开出的特码的个位数加上十位数之和为奇数称合数单，之和为偶称合数双，其中号码49为和。例如：合数单，01为0+1=1，23为2+3=5；合数双，28为2+8=10，39为3+9=12；49为和。</li>
                        <li>
                            波色：指开出特码所属的颜色。
                            <ul>
                                <li>红色号码包括：01，02，07，08，12，13，18，19，23，24，29，30，34，35，40，45，46</li>
                                <li>蓝色号码包括：03，04，09，10，14，15，20，25，26，31，36，37，41，42，47，48</li>
                                <li>绿色号码包括: 05，06，11，16，17，21，22，27，28，32，33，38，39，43，44，49</li>
                            </ul>
                        </li>
                        <li>正码1-6：正码1、正码2、正码3、正码4、正码5、正码6的大小单双、波色、合数单双和特别号码的大小单双、波色、合数单双规则相同，如正码1为25，则正码1为大，为单，为蓝波；正码2为2，则正码2为小，为双，为红波；号码为49时，则大小单双、合数单双为和，波色为绿。</li>
                        <li>
                            生肖：指开奖7个号码中含有所属生肖的一个或多个号码，但派彩只派一次，即不论同生肖号码出现一个或多个号码都只派彩一次。
                            <ul>
<?php foreach($LOT['animal'] as $key=>$val){ ?>                                <li><?php echo $key; ?>包括：<?php echo implode(',', $val); ?></li>
<?php } ?>                            </ul>
                        </li>
                        <li>
                            尾数：指7个开奖号码中含有所属尾数的一个或多个号码，不论同尾数的号码出现一个或多个，派彩只派一次。
                            <ul>
                                <li>0尾包括：10，20，30，40</li>
                                <li>1尾包括：01，11，21，31，41</li>
                                <li>2尾包括：02，12，22，32，42</li>
                                <li>3尾包括：03，13，23，33，43</li>
                                <li>4尾包括：04，14，24，34，44</li>
                                <li>5尾包括：05，15，25，35，45</li>
                                <li>6尾包括：06，16，26，36，46</li>
                                <li>7尾包括：07，17，27，37，47</li>
                                <li>8尾包括：08，18，28，38，48</li>
                                <li>9尾包括：09，19，29，39，49</li>
                            </ul>
                        </li>
                        <li>
                            半波：以特码色波和特码单双大小为一个投注组合，当开出特码符合投注组合，即视为中奖。若开出特码为49号时，所有投注半波任一个组合视为和局，其余情况视为不中奖
                        </li>
                        <li>六肖：挑选6个生肖为一投注组合，投注类别可选择该投注组合为中或不中。当期开出特码符合所选生肖及投注类别，即视为中奖。号码49为和局。</li>
                        <li>
                            一肖：指开出的7个开奖号码中含有投注所属生肖的一个或多个号码，即视为中奖，不论同生肖的号码出现一个或多个，派彩只派一次。
                            <ul>
<?php foreach($LOT['animal'] as $key=>$val){ ?>                                <li><?php echo $key; ?>包括：<?php echo implode(',', $val); ?></li>
<?php } ?>                            </ul>
                            </ul>
                        </li>
                        <li>
                            连码：每个号码都有自己的赔率，下注组合的总赔率，取该组合号码的最低赔率为总赔率。
                            <ul>
                                <li>三中二：所投注的每三个号码为一组合，若其中2个是开奖号码中的正码，视为中奖，叫三中二；若3个都是开奖号码中的正码，叫三中二之中三，其余情形视为不中奖，如03、04、05为一组合，开奖号码中有03、04两个正码，没有05，叫三中二，按三中二赔付；如开奖号码中有03、04、05三个正码，叫三中二之中三，按中三赔付；如出现1个或没有，视为不中奖。</li>
                                <li>三全中：每三个号码为一组合，若三个号码都是开奖号码之正码，视为中奖，其余情形视为不中奖。如03、04、05三个都是开奖号码之正码，视为中奖，如两个正码加上一个特别特码视为不中奖。</li>
                                <li>二全中：每二个码号为一组合，二个号码都是开奖码号之正码，视为中奖，其余情形视为不中奖（含一个正码加一个特别号码之情形）。</li>
                                <li>二中特：每二个号码为一组合，二个号码都是开奖号码之正码，叫二中特之二中；若其中一个是正码，一个是特别号码，叫二中特之中特；其余情形视为不中奖。</li>
                                <li>特串：每二个号码为一组合，其中一个是正码，一个是特别号码，视为中奖，其余情形视为不中奖（含二个号码都是正码之情形）。</li>
                            </ul>

                        </li>
                        <li>
                            不中：每个号码都有自己的赔率，下注组合的总赔率，取该组合号码的最低赔率为赔率。
                            <ul>
                                <li>五不中：所投注的每五个号码为一注，每注的五个号码中如果没有当期开奖的所有7个号码中的任意一个，则视为中奖；否则视为不中奖。例如开奖号码是：6,7,8,9,10,11,12，若你投的是1,2,3,4,5则中奖，而投1,2,3,4,6则不中奖。</li>
                                <li>六不中：所投注的每六个号码为一注，每注的六个号码中如果没有当期开奖的所有7个号码中的任意一个，则视为中奖；否则视为不中奖。例如开奖号码是：7,8,9,10,11,12,13，若你投的是1,2,3,4,5,6则中奖，而投1,2,3,4,5,7则不中奖。</li>
                                <li>七不中：所投注的每七个号码为一注，每注的七个号码中如果没有当期开奖的所有7个号码中的任意一个，则视为中奖；否则视为不中奖。例如开奖号码是：8,9,10,11,12,13,14，若你投的是1,2,3,4,5,6,7则中奖，而投1,2,3,4,5,6,8则不中奖</li>
                                <li>八不中：所投注的每八个号码为一注，每注的八个号码中如果没有当期开奖的所有7个号码中的任意一个，则视为中奖；否则视为不中奖。例如开奖号码是：9,10,11,12,13,14,15，若你投的是1,2,3,4,5,6,7,8则中奖，而投1,2,3,4,5,6,7,9则不中奖。</li>
                                <li>九不中：所投注的每九个号码为一注，每注的九个号码中如果没有当期开奖的所有7个号码中的任意一个，则视为中奖；否则视为不中奖。例如开奖号码是：10,11,12,13,14,15,16，若你投的是1,2,3,4,5,6,7,8,9则中奖，而投1,2,3,4,5,6,7,8,10则不中奖。</li>
                                <li>十不中：所投注的每十个号码为一注，每注的十个号码中如果没有当期开奖的所有7个号码中的任意一个，则视为中奖；否则视为不中奖。例如开奖号码是：11,12,13,14,15,16,17，若你投的是1,2,3,4,5,6,7,8,9,10则中奖，而投1,2,3,4,5,6,7,8,9,11则不中奖。</li>
                            </ul>
                        </li>
                        <li>
                            生肖连：（生肖所对应的号码和特码生肖项目的一样；一个生肖对应多个号码，不论同生肖的号码出现一个或多个，派彩只派一次。每个生肖都有自己的赔率，下注组合的总赔率，取该组合生肖的最低赔率为总赔率。 ）
                            <ul>
                                <li>二肖连[中]：选择二个生肖为一投注组合进行下注。该注的二个生肖必须在当期开出的7个开奖号码相对应的生肖中，视为中奖</li>
                                <li>三肖连[中]：选择三个生肖为一投注组合进行下注。该注的三个生肖必须在当期开出的7个开奖号码相对应的生肖中，视为中奖。</li>
                                <li>四肖连[中]：选择四个生肖为一投注组合进行下注。该注的四个生肖必须在当期开出的7个开奖号码相对应的生肖中，视为中奖。</li>
                                <li>二肖连[不中]：选择二个生肖为一投注组合进行下注。该注的二个生肖必须没在当期开出的7个开奖号码相对应的生肖中，视为中奖</li>
                                <li>三肖连[不中]：选择三个生肖为一投注组合进行下注。该注的三个生肖必须没在当期开出的7个开奖号码相对应的生肖中，视为中奖。</li>
                                <li>四肖连[不中]：选择四个生肖为一投注组合进行下注。该注的四个生肖必须没在当期开出的7个开奖号码相对应的生肖中，视为中奖。</li>
                            </ul>
                        </li>
                        <li>
                            尾数连：（尾数所对应的号码和尾数项目的一样；一个尾数对应多个号码，不论同尾数的号码出现一个或多个，派彩只派一次。每个尾数都有自己的赔率，下注组合的总赔率，取该组合尾数的最低赔率为总赔率）
                            <ul>
                                <li>二尾连[中]：选择二个尾数为一投注组合进行下注。该注的二个尾数必须在当期开出的7个开奖号码相对应的尾数中，视为中奖。</li>
                                <li>三尾连[中]：选择三个尾数为一投注组合进行下注。该注的三个尾数必须在当期开出的7个开奖号码相对应的尾数中，视为中奖。</li>
                                <li>四尾连[中]：选择四个尾数为一投注组合进行下注。该注的四个尾数必须在当期开出的7个开奖号码相对应的尾数中，视为中奖。</li>
                                <li>二尾连[不中]：选择二个尾数为一投注组合进行下注。该注的二个尾数必须没在当期开出的7个开奖号码相对应的尾数中，视为中奖。</li>
                                <li>三尾连[不中]：选择三个尾数为一投注组合进行下注。该注的三个尾数必须没在当期开出的7个开奖号码相对应的尾数中，视为中奖。</li>
                                <li>四尾连[不中]：选择四个尾数为一投注组合进行下注。该注的四个尾数必须没在当期开出的7个开奖号码相对应的尾数中，视为中奖。</li>
                            </ul>
                        </li>
                        <li>1-6龙虎： 开出的正码1-6号码数值比较，前面大于后面的为龙；反之，后面大于前面为虎；如：正码1-6开出号码为13、25、2、7、15、32，则1-2（虎），1-3（龙），1-4（龙），1-5（虎），1-6（虎），2-3(龙），2-4（龙），2-5（龙），2-6（虎），3-4（虎），3-5（虎），3-6（虎），4-5（虎）4-6（虎）5-6（虎），下注与之对应为中奖，其余为不中</li>
                        <li>特肖：当期开奖的特码对应的生肖是投注选择的生肖，即为中奖，否则为不中奖，49号不算和。如投注特肖"龙"，若开出特码为 6,18,30,42 中的任一个，则中奖，否则不中奖 </li>
                        <li>多组投注：是一种快速下注模式，可以连续选择多组号码进行下注。[应用于五不中等项目]</li>
                        <li>生肖对碰：是一种简易模式，生肖都相对应号码，选择两个生肖对碰下注，相应是选择多个号码组合成不重复组合进行下注。[应用于连码等项目] </li>
                        <li>生肖尾数对碰：是一种简易模式，生肖和尾数都相对应号码，选择生肖尾数对碰下注，相应是选择多个号码组合成不重复组合进行下注。[应用于连码等项目] </li>
                        <li>尾数对碰：是一种简易模式，尾数都相对应号码，选择两个尾数对碰下注，相应是选择多个号码组合成不重复组合进行下注。[应用于连码等项目] </li>
                        <li>家禽、野兽：是一种快速下注模式，根据十二生肖其动物特性来区分。家禽包括：牛、马、羊、鸡、狗、猪；野兽包括：鼠、虎、兔、龙、蛇、猴。[应用于特码生肖、六肖等项目] </li>
                        <li>拖头：拖头是多组连码的简化叫法。 如二中二之8拖18、28、13、25，即是4组：8-18、8-28、8-13、8-25； 如三中二之8、18拖19、20、21，即是三组：8-18-19、8-18-20、8-18-21。 </li>
                        <li>复式：复式是多个号码的不完全重复组合。 </li>
                    </ol>
                </div>
            </div>
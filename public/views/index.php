
<!--wrapper starts-->
<div id="wrapper">
    <!--container starts-->
    <div id="container">
        <!--ltcontent starts-->
        <div id="ltcontent">
            <!--hdlogo starts-->
            <div id="hdlogo" align="center">
                <img src="/images/topbanner.jpg" alt=""/>
            </div>
            <!--hdlogo ends-->
            <!--about starts-->
            <div id="about">
                <div class="lthead" align="center"><span class="tphead">About Authors Bio</span></div>
                <div class="ltdetail">
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                </div>
                <div class="link">
                    Get in touch with us
                </div>
            </div>
            <!--about ends-->
            <div class="ltgap"></div>
            <!--popular starts-->
            <div id="mostpop">
                <div class="lthead"><span>most popular posts</span></div>
                <!--ltposts starts-->
                <div class="ltposts">
                    <ul>
                        <li><a href="#">Vero</a></li>
                        <li><a href="#">Harum</a></li>
                        <li><a href="#">Expedia</a></li>
                        <li><a href="#">Omnis</a></li>
                        <li><a href="#">Voluptatum</a></li>
                    </ul>
                </div>
                <!--ltposts ends-->
                <!--rtposts starts-->
                <div class="rtposts">
                    <ul>
                        <li><a href="#">Nauts</a></li>
                        <li><a href="#">Video 3</a></li>
                        <li><a href="#">Adipisci</a></li>
                        <li><a href="#">Numquam</a></li>
                        <li><a href="#">Vel Illium</a></li>
                    </ul>
                </div>
                <!--rtposts ends-->
                <div class="clear"></div>
            </div>
            <!--popular ends-->
            <div class="ltgap"></div>
            <!-- search starts-->
            <div id="search">
                <div class="input">
                    <input type="text" name="search" class="textbox"/> <input type="submit" value="SEARCH" class="searchBut" />
                </div>
            </div>
            <!--search ends-->
            <div class="ltgap"></div>
            <!--about starts-->
            <div id="feeds">
                <div class="lthead" align="center"><span class="tphead">subscribe to feeds</span></div>
                <div class="ltdetail">
                    <ul>
                        <li><a href="#">Subscribe to blog updates</a></li>
                        <li><a href="#">Subscribe to screen-cast updates</a></li>
                    </ul>
                </div>
            </div>
            <!--about ends-->
            <div class="ltgap"></div>
            <!--about starts-->
            <div id="social">
                <div class="lthead"><span>my social networks</span></div>
                <div>
                    <a href="#"><img src="/images/link1.png" alt="" /></a>
                    <a href="#"><img src="/images/link2.png" alt="" /></a>
                    <a href="#"><img src="/images/link3.png" alt="" /></a>
                    <a href="#"><img src="/images/link4.png" alt="" /></a>
                    <a href="#"><img src="/images/link5.png" alt="" /></a>
                </div>
            </div>
            <!--about ends-->
        </div>
        <!--ltcontent ends-->
        <!--rtcontent starts-->
        <div id="rtcontent">
            <!--publish starts-->
            <div class="publish">Published by Envira Media</div>
            <!--publish ends-->
            <!--head starts-->
            <div class="head">Video Blog</div>
            <!--head ends-->
            <!--tagln starts-->
            <div class="tagln">
                It is a <span class="italics">long</span> established fact <span class="italics">that</span> a reader<br />
                will love your work, as long as you put all you have into the project
            </div>
            <!--tagln ends-->
            <!--menulinks starts -->
            <div id="menulinks">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">reel</a></li>
                    <li><a href="#">about</a></li>
                    <li><a href="#" class="scrcast">screen-casts</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <!--menulinks ends -->
            <!-- шаблон с php кодом в коде html - активный
             можно создать пассивный шаблон-->
            <?php if (isset($posts)) {
                foreach ($posts as $post): ?>
            <!--documentarty starts-->
            <div class="document">
                <div>&nbsp;</div>
                <div class="dochead">
                    <span><a href="/?c=posts&a=post&id=<?=$post['id']?>" class="dhead"><?=$post['title']?></a></span>
                </div>
                <div>
                    <span class="post">posted by admin | september 3, 2009</span>
                </div>
                <div class="dcontent">
                    <img src="<?=$post['image']?>" alt="" style="float: left; margin: 10px"/>
                    <?=$post['text']?>
                </div>
                <div class="bubble" align="right">
                    <span><?=$post['comments']?></span>
                </div>
            </div>
            <div class="rtboxbg">&nbsp;</div>
            <!--documentary ends-->
            <div class="gap"></div>
            <?php endforeach;
            } ?>
            <!--Helping ends-->
        </div>
        <!--rtcontent ends-->
        <div class="clear"></div>
        <br />
        <!--feature starts-->
        <div id="features">
            <div id="tranbox">
                <div class="tranhead">1914 translation</div>
                <span class="trapost">posted by admin | september 3, 2010</span>
                <div class="tracontent">
                    On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain.
                </div>
            </div>

            <div id="video">
                <img src="/images/video.jpg" alt=""/>
            </div>
            <div class="clear"></div>
        </div>
        <!--features ends-->
        <!--footer starts-->
        <div id="footer">
            <div class="copy">
                &copy; 2010 Make Film Work
            </div>
            <div class="flinks">
                <span><a href="#">HOME</a></span><span class="separator"> | </span>
                <span><a href="#">ABOUT</a></span><span class="separator"> | </span>
                <span><a href="#">REEL</a></span><span class="separator"> | </span>
                <span><a href="#">SCREENCASTS</a></span><span class="separator"> | </span>
                <span><a href="#">CONTACT</a></span><span class="separator"> | </span>
                <span><a href="http://vectorart.org">Design by Vector</a></span>
            </div>
        </div>
        <!--footer ends-->
    </div>
    <!--container starts-->
</div>
<!--wrapper ends-->
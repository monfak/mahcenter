<?php
if(!function_exists('parse_url_rel')) {
    /**
     * <code>rel=&quot;nofollow&quot;</code> and <code>target=&quot;_blank&quot;</code> will be added automatically,
     * for all the external links of your website <strong>posts</strong> or <strong>pages</strong>.
     * Also you can <strong>exclude domains</strong>, not to add <code>rel=&quot;nofollow&quot;</code> for the selected external links.
     * @param $content
     * @return mixed
     */
    function parse_url_rel($content) {
        $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
        if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
            if( !empty($matches) ) {
                $ownDomain = $_SERVER['HTTP_HOST'];
                $exclude_domains_list = explode(",", get_setting('exclude_domains'));
                for ($i = 0; $i < count($matches); $i++)
                {
                    $tag  = $matches[$i][0];
                    $tag2 = $matches[$i][0];
                    $url  = $matches[$i][0];

                    // bypass #more type internal link
                    $res = preg_match('/href(\s)*=(\s)*"#[a-zA-Z0-9-_]+"/',$url);
                    if($res) {
                        continue;
                    }

                    $pos = strpos($url,$ownDomain);
                    if ($pos === false) {
                        $domainCheckFlag = true;

                        if(count($exclude_domains_list) > 0) {
                            $exclude_domains_list = array_filter($exclude_domains_list);
                            foreach($exclude_domains_list as $domain) {
                                $domain = trim($domain);
                                if($domain!='') {
                                    $domainCheck = strpos($url,$domain);
                                    if($domainCheck === false) {
                                        continue;
                                    } else {
                                        $domainCheckFlag = false;
                                        break;
                                    }
                                }
                            }
                        }

                        $noFollow = '';

                        // add target=_blank to url
                        $pattern = '/target\s*=\s*"\s*_blank\s*"/';
                        preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                        if( count($match) < 1 )
                            $noFollow .= ' target="_blank"';

                        //exclude domain or add nofollow
                        if($domainCheckFlag) {
                            $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                            preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                            if(count($match) < 1)
                                $noFollow .= ' rel="nofollow"';
                        }

                        // add nofollow/target attr to url
                        $tag = rtrim ($tag,'>');
                        $tag .= $noFollow . '>';
                        $content = str_replace($tag2, $tag, $content);
                    }
                }
            }
        }

        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }
}
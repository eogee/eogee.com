<?php
    $indexData = $data['indexData'];
    use Easy\View\View;
    View::view('/index/head', $indexData);
    $data = $data['data'];
    // 创建 ParsedownExtra 实例
    $ParsedownExtra = new ParsedownExtra();

    // 创建 Highlighter 实例
    $Highlighter = new Highlight\Highlighter();

    $markdownText = "
# 这是一个标题
## 这是一个副标题
**这是一个加粗的文本**

*这是一个斜体的文本*

~~这是一个删除线的文本~~

> 这是一个引用

`eogee.com`

1. 列表项1
2. 列表项2
3. 列表项3

[这是一个链接](https://eogee.com)

这是普通文本。
- 列表项1
- 列表项2
```php
<?php
echo 'Hello, World!';
?>
```";

    $html = $ParsedownExtra->text($markdownText);

    $highlightedHtml = preg_replace_callback(
        '/<code class="language-(.*?)">(.*?)<\/code>/s',
        function ($matches) use ($Highlighter) {
            $language = $matches[1];
            $code = htmlspecialchars_decode($matches[2]); // 解码 HTML 实体
            $result = $Highlighter->highlight($language, $code);
            return '<code class="hljs language-' . $language . '">' . $result->value . '</code>';
        },
        $html
    );
    
?> 
<div class="eog-container">
    <div class="layui-container">
        <?php
            echo $highlightedHtml;
        ?>
    </div>
</div>

<?php
    View::view('/index/foot',$indexData);
?>



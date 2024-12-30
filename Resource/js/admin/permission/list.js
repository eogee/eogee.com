/**
 * content list.js
 */
tableHeadSet();// 表头设置
tableHeadData();// 表格及字段数据

if (window.innerWidth > 850){
    var cols = [
        {checkbox: true}
        ,{field: 'id',title: tableFiledComment.id,sort: true,maxWidth : 98}
        ,{field: 'top',title:  tableFiledComment.top,hide: true}
        ,{field: 'title',title:  tableFiledComment.title}
        ,{field: 'titleAbbre',title:  tableFiledComment.titleAbbre,hide: true}
        ,{field: 'titleColor',title:  tableFiledComment.titleColor,hide: true}
        ,{field: 'titleShadowColor',title:  tableFiledComment.titleShadowColor,hide: true}
        ,{field: 'keywords',title:  tableFiledComment.keywords,hide: true}
        ,{field: 'description',title:  tableFiledComment.description,hide: true}
        ,{field: 'backgroundImage',title:  tableFiledComment.backgroundImage,hide: true}
        ,{field: 'keynote',title:  tableFiledComment.keynote}
        ,{field: 'keynoteColor',title:  tableFiledComment.keynoteColor,hide: true}
        ,{field: 'keynoteShadowColor',title: tableFiledComment.keynoteShadowColor,hide: true}
        ,{field: 'content',title:  tableFiledComment.content}
        ,{field: 'contentColor',title: tableFiledComment.contentColor,hide: true}
        ,{field: 'contentShadowColor',title:  tableFiledComment.contentShadowColor,hide: true}
        ,{field: 'detail',title: tableFiledComment.detail,hide: true}
        ,{field: 'detailColor',title:  tableFiledComment.detailColor,hide: true}
        ,{field: 'detailShadowColor',title:  tableFiledComment.detailShadowColor,hide: true}
        ,{field: 'newsContent',title:  tableFiledComment.newsContent,hide: true}
        ,{field: 'btn1',title:  tableFiledComment.btn1}
        ,{field: 'btn1url',title:  tableFiledComment.btn1url,hide: true}
        ,{field: 'btn2',title:  tableFiledComment.btn2}
        ,{field: 'btn2url',title:  tableFiledComment.btn2url,hide: true}
        ,{field: 'sort',title:  tableFiledComment.sort,sort: true}
        ,{fixed: '',title: '操作',width: handleColwidth,toolbar: '#rowToolbar'}
    ];
}

var mobileCol = document.getElementById("mobileCol");
mobileCol.innerHTML = `
    <ul>
        <li><strong>{{ tableFiledComment.id }}:</strong> {{ d.id }} </li>
        <li><strong>{{ tableFiledComment.title }}:</strong> {{ d.title }} </li>
        <li><strong>{{ tableFiledComment.keynote }}:</strong> {{ d.keynote }} </li>
        <li><strong>{{ tableFiledComment.content }}:</strong> {{ d.content }} </li>
        <li><strong>{{ tableFiledComment.btn1 }}:</strong> {{ d.btn1 }} </li>
        <li><strong>{{ tableFiledComment.btn2 }}:</strong> {{ d.btn2 }} </li>
        <li><strong>{{ tableFiledComment.sort }}:</strong> {{ d.sort }} </li>
    </ul>
`;

var toolbar = document.getElementById("toolbar");
toolbar.innerHTML = `
    <button id="insert" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="insert">新增</button>
    <button id="deleteSoftBatch" class="layui-btn layui-btn-danger layui-btn-sm" lay-event="deleteSoftBatch">批量删除</button>`;

var toolbar = document.getElementById("rowToolbar");
toolbar.innerHTML = `
    <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="show">详情</button>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</button>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="deleteSoft">删除</button>            
`;

var toolbar = document.getElementById("rowToolbarMobile");
toolbar.innerHTML = `
    <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="show">详情</button><br/>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</button><br/>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="deleteSoft">删除</button>
`;

renderTable();
renderPage();
insertRow();
batch();
rowToolbar(); 
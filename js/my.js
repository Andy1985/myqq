function getXmlHttpRequest()
{
    if (window.ActiveXObject)
    {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    else
    {
        return new XMLHttpRequest();
    }
}

function $(id)
{
    return document.getElementById(id);
}

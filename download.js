var supportedPlatforms = ['mac-os-x', 'windows', 'linux'];
var platform = identifyPlatform();
var showAllLink = null;


/*	hideOtherPlatforms()
	Hide <div>s for platforms other than the browser's current platform.
	If current platform is unknown, does nothing.
	Currently only run at page load time, but can be safely re-run.
*/
function hideOtherPlatforms()
{
	// Don't even try it in un-DOMmy browsers
	if (!supportDOM())  return;
	
	// If we can't recognize the platform, show all
	if (!platform)  return;
	
	// Iterate over known platforms
	for (var i = 0; i < supportedPlatforms.length; i++)
	{
		var curr = supportedPlatforms[i];
		var div = document.getElementById('oolite-dl-' + curr);
	//	if (!div)  continue;
		
		// if ith platform is not the current platform...
		if (curr != platform)
		{
			// ...hide its div.
			div.style.display = 'none';
		}
		else
		{
			// This is the current platform; add (or show) "Show all platforms..." link.
			if (!showAllLink)
			{
				div.innerHTML += '<p id="oolite-dl-show-all"><a class="pseudo-control" href="javascript:showAllPlatforms()">Show all platforms...</a></p>';
				showAllLink = document.getElementById('oolite-dl-show-all');
				if (!showAllLink && div.children)
				{
					showAllLink = div.children.namedItem('oolite-dl-show-all');
				}
			}
			else
			{
				showAllLink.style.display = "inline";
			}
		}
	}
}


/*	showAllPlatforms()
	Show <div>s for all platforms, and hide "show all" link.
	If current platform is unknown, does nothing.
*/
function showAllPlatforms()
{
	if (!supportDOM() || !platform)  return;
	
	// Show all platforms' divs
	for (var i = 0; i < supportedPlatforms.length; i++)
	{
		var curr = supportedPlatforms[i];
		var div = document.getElementById('oolite-dl-' + curr);
		
		if (div)  div.style.display = 'block';
	}
	
	// Remove "Show all platforms..." link.
	showAllLink.style.display = "none";
}


function supportDOM()
{
	return Boolean(document.getElementById);
}


function identifyPlatform()
{
	var result = platformFromPlatformString();
	if (!result)  result = platformFromUserAgentString();
	return result;
}


function platformFromPlatformString()
{
	// The platform string is the preferred method.
	var platform = null;
	if (window.navigator)  platform = window.navigator.platform;
	if (!platform && window.clientInformation)  platform = window.clientInformation.platform;
	if (platform)
	{
		if (platform.indexOf('Mac') == 0)
		{
			return 'mac-os-x';
		}
		else if (platform.indexOf('Win') == 0)
		{
			return 'windows';
		}
		else if ((platform.indexOf('Linux') == 0) || (platform.indexOf('BSD') != 0))
		{
			return 'linux';
		}
	}
	return null;
}


function platformFromUserAgentString()
{

	// No platform string or unknown platform string try sniffing the userAgent (urgh).
	var userAgent = null;
	if (window.clientInformation)  userAgent = window.clientInformation.userAgent;
	if (!userAgent && window.navigator)  userAgent = window.navigator.userAgent;
	if (userAgent)
	{
		if ((userAgent.indexOf('Macintosh') != -1) || (userAgent.indexOf('Mac OS X') != -1))
		{
			return 'mac-os-x';
		}
		else if ((userAgent.indexOf('Linux') != -1) || (userAgent.indexOf('BSD') != -1))
		{
			return 'linux';
		}
		else if ((userAgent.indexOf('Windows') != -1) || (userAgent.indexOf('Win32') != -1) || (userAgent.indexOf('Win64') != -1))
		{
			return 'windows';
		}
	}
	
	return null;
}


function init()
{
	// Only execute once
	if (arguments.callee.done)  return;
	hideOtherPlatforms();
}


var onDOMLoaded=function(f,t)
{
    if(typeof document.getElementsByTagName!='undefined' && (document.getElementsByTagName('body')[0]!=null || document.body!=null))
	{
        var h=document.getElementsByTagName('HTML')[0];
        var s=document.createElement('script');
        s.type='text/javascript';
        h.appendChild(s);
        s.text=f+'()';
    }
	else if(100 > t)
	{
        setTimeout(function () { onDOMLoaded(f,t) } ,t);
        if (10 > t) { t++; } else { t += 10; }
    }
};


onDOMLoaded('init', 0);
window.onload = init;

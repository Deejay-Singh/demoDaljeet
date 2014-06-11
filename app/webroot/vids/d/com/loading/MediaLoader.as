package com.loading
{
	import flash.display.Loader;
	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.events.ProgressEvent;
	import flash.events.SecurityErrorEvent;
	import flash.net.URLRequest;
	import flash.system.ApplicationDomain;
	import flash.system.LoaderContext;
	
	/**
	 * ...
	 * @author rakesh
	 * @version 1.0
	 */
	public class MediaLoader 
	{
		var ldr:Loader;
		var _callBackFunction:Function;
		var _progressFunction:Function;
		var id:String;
		
		public function MediaLoader()
		{
			
		}
		public function load(path:String,cFun:Function=null,pFun:Function=null,id:String="")
		{
			_callBackFunction = cFun;
			_progressFunction = pFun;
			
			this.id = id;
			ldr = new Loader();
			ldr.load(new URLRequest(path),new LoaderContext(true, new ApplicationDomain(ApplicationDomain.currentDomain.parentDomain)));
			ldr.addEventListener(IOErrorEvent.IO_ERROR, IOErrorHandler);
			ldr.contentLoaderInfo.addEventListener(Event.COMPLETE, completeHandler);
			ldr.addEventListener(SecurityErrorEvent.SECURITY_ERROR, securityErrorHandler);
			ldr.contentLoaderInfo.addEventListener(ProgressEvent.PROGRESS,progressHandler)
		}
		
		private function progressHandler(e:ProgressEvent):void 
		{
			if (_progressFunction != null)
			{
				_progressFunction((e.bytesLoaded/e.bytesTotal)*100,id);
			}
		}
		
		private function securityErrorHandler(e:SecurityErrorEvent):void 
		{
			trace("Security Error generated");
		}
		private function IOErrorHandler(e:IOErrorEvent):void 
		{
			trace("IOError captured...");
			if (_callBackFunction != null)
			{
				_callBackFunction("",id);
			}
			removeListener();
			ldr = null;
		}
		private function completeHandler(e:Event)
		{
			if (_callBackFunction != null)
			{
				_callBackFunction(ldr,id);
			}
			removeListener();
			ldr = null;
		}
		private function removeListener()
		{
			ldr.removeEventListener(IOErrorEvent.IO_ERROR, IOErrorHandler);
			ldr.contentLoaderInfo.removeEventListener(Event.COMPLETE, completeHandler);
			ldr.removeEventListener(SecurityErrorEvent.SECURITY_ERROR, securityErrorHandler);
			ldr.removeEventListener(ProgressEvent.PROGRESS,progressHandler)
		}
	}	
}
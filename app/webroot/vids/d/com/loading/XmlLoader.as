package com.loading
{
	/**
	 * ...
	 * @author rakesh kumar
	 */
	
	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	 
	public class XmlLoader
	{
		private var _locCallBackFunc:Function;
		private var myLoader:URLLoader
		
		/**
		 * Loads the xml
		 * @param	fileName
		 * @param	callbackFunc
		 */
		public function loadXml(fileName:String, callbackFunc:Function) 
		{
			//trace(fileName)
			_locCallBackFunc = callbackFunc;
			myLoader = new URLLoader();
			myLoader.load(new URLRequest(fileName));
			//adding event
			myLoader.addEventListener(Event.COMPLETE, onLoadXml );
			myLoader.addEventListener(IOErrorEvent.IO_ERROR,IOErrorHandler)
		}
		
		private function IOErrorHandler(e:IOErrorEvent):void 
		{
			trace("XML not found");
		}
		
		// call function when xml loading is done
		private function onLoadXml(e:Event) 
		{
			var myXML:XML = new XML(e.target.data);
			_locCallBackFunc(myXML);
			myLoader.removeEventListener(Event.COMPLETE, onLoadXml);
		}
	}
}
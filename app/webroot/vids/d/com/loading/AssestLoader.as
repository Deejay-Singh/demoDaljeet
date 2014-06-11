package com.loading
{
	import flash.display.Loader;
	
	/**
	 * ...
	 * @author rakesh
	 */
	public class AssestLoader 
	{
		private var _lArr:Array;
		private var current:int;
		private var _callBackFunction:Function;
		private var _progress:Function;
		private var id:String;
		private var dArray:Array;
		private var partLoad:Number;
		
		public function AssestLoader()
		{
			
		}
		public function load(arr:Array,cFun:Function=null,pFun=null,id:String="")
		{
			_lArr = arr;
			_callBackFunction = cFun;
			_progress = pFun;
			this.id = id;
			
			partLoad = 100 / _lArr.length;
			
			dArray = new Array();
			
			current = 0;
			loadMedia(_lArr[current], _completeFunction, _progressFunction, this.id + "_" + current);
		}
		private function _completeFunction(ldr:Loader,id:String)
		{
			dArray.push(ldr);
			
			current++;
			if (current < _lArr.length)
			{
				loadMedia(_lArr[current], _completeFunction, _progressFunction, this.id + "_" + current);
			}
			else
			{
				_callBackFunction(dArray, this.id);
			}
		}
		private function _progressFunction(per:Number,id:String)
		{			
			var totalL = Math.floor(partLoad * current +  partLoad / 100 * per);
			
			if (_progress != null) {
				_progress(totalL, this.id);
			}
		}
		private function loadMedia(path:String, cFun:Function, pFun:Function, id:String)
		{
			new MediaLoader().load(path, cFun, pFun, id);
		}
		
	}
	
}
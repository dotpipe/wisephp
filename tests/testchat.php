<?php

namespace wise\src\chat;

require_once '\wise\src\chat\ChatBox.php';

 class ChatBoxTest extends ChatBox {

	public function testCheckForFunctionupdateChatFile() 
	{
		$obj = new ChatBox();
		$testReturn = $obj->updateChatFile();
	}
	public function testCheckForFunctionchatCheck() 
	{
		$obj = new ChatBox();
		$testReturn = $obj->chatCheck();
	}
	public function testCheckForFunctionflagComment() 
	{
		$obj = new ChatBox();
		$testReturn = $obj->flagComment();
	}
	public function testCheckForFunctiongetfilename() 
	{
		$obj = new ChatBox();
		$testReturn = $obj->getfilename();
	}
	public function testCheckForFunctionsetconduct() 
	{
		$obj = new ChatBox();
		$testReturn = $obj->setconduct();
	}
	public function testCheckForFunctionnewconduct() 
	{
		$obj = new ChatBox();
		$testReturn = $obj->newconduct();
	}
	public function testCheckForFunctioncreateChat() 
	{
		$obj = new ChatBox();
		$testReturn = $obj->createChat();
	}
}
?>
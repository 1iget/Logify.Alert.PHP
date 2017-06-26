<?php
class LogifyException{
    public $type;
    public $message;
    public $stackTrace;
    public $normalizedStackTrace;
}

//exception": [
//-{
//"type": "System.AggregateException",
//"message": "One or more errors occurred.",
//"stackTrace": "   at System.Threading.Tasks.Task.ThrowIfExceptional(Boolean includeTaskCanceledExceptions)\r\n   at System.Threading.Tasks.Task.Wait(Int32 millisecondsTimeout, CancellationToken cancellationToken)\r\n   at SpreadsheetService.WebApiApplication.Session_End(Object sender, EventArgs e)",
//"normalizedStackTrace": "System.Threading.Tasks.Task.ThrowIfExceptional(Boolean includeTaskCanceledExceptions)\r\nSystem.Threading.Tasks.Task.Wait(Int32 millisecondsTimeout, CancellationToken cancellationToken)\r\nSpreadsheetService.WebApiApplication.Session_End(Object sender, EventArgs e)\r\n"
//},
//-{
//"type": "System.ArgumentException",
//"message": "The argument must not be empty string.\r\nParameter name: containerName",
//"stackTrace": "   at Microsoft.WindowsAzure.Storage.Core.Util.CommonUtility.AssertNotNullOrEmpty(String paramName, String value)\r\n   at Microsoft.WindowsAzure.Storage.Blob.CloudBlobClient.GetContainerReference(String containerName)\r\n   at SpreadsheetService.Helpers.AzureStorage.<Upload>d__15.MoveNext()\r\n--- End of stack trace from previous location where exception was thrown ---\r\n   at System.Runtime.CompilerServices.TaskAwaiter.ThrowForNonSuccess(Task task)\r\n   at System.Runtime.CompilerServices.TaskAwaiter.HandleNonSuccessAndDebuggerNotification(Task task)\r\n   at SpreadsheetService.Helpers.AzureStorage.<Upload>d__13.MoveNext()\r\n--- End of stack trace from previous location where exception was thrown ---\r\n   at System.Runtime.CompilerServices.TaskAwaiter.ThrowForNonSuccess(Task task)\r\n   at System.Runtime.CompilerServices.TaskAwaiter.HandleNonSuccessAndDebuggerNotification(Task task)\r\n   at SpreadsheetService.Helpers.DocumentStore.<Upload>d__4.MoveNext()\r\n--- End of stack trace from previous location where exception was thrown ---\r\n   at System.Runtime.CompilerServices.TaskAwaiter.ThrowForNonSuccess(Task task)\r\n   at System.Runtime.CompilerServices.TaskAwaiter.HandleNonSuccessAndDebuggerNotification(Task task)\r\n   at SpreadsheetService.Helpers.DocumentStore.<Upload>d__3.MoveNext()",
//"normalizedStackTrace": "Microsoft.WindowsAzure.Storage.Core.Util.CommonUtility.AssertNotNullOrEmpty(String paramName, String value)\r\nMicrosoft.WindowsAzure.Storage.Blob.CloudBlobClient.GetContainerReference(String containerName)\r\nSpreadsheetService.Helpers.AzureStorage.<Upload>d__15.MoveNext()\r\n--- End of stack trace from previous location where exception was thrown ---\r\nSystem.Runtime.CompilerServices.TaskAwaiter.ThrowForNonSuccess(Task task)\r\nSystem.Runtime.CompilerServices.TaskAwaiter.HandleNonSuccessAndDebuggerNotification(Task task)\r\nSpreadsheetService.Helpers.AzureStorage.<Upload>d__13.MoveNext()\r\n--- End of stack trace from previous location where exception was thrown ---\r\nSystem.Runtime.CompilerServices.TaskAwaiter.ThrowForNonSuccess(Task task)\r\nSystem.Runtime.CompilerServices.TaskAwaiter.HandleNonSuccessAndDebuggerNotification(Task task)\r\nSpreadsheetService.Helpers.DocumentStore.<Upload>d__4.MoveNext()\r\n--- End of stack trace from previous location where exception was thrown ---\r\nSystem.Runtime.CompilerServices.TaskAwaiter.ThrowForNonSuccess(Task task)\r\nSystem.Runtime.CompilerServices.TaskAwaiter.HandleNonSuccessAndDebuggerNotification(Task task)\r\nSpreadsheetService.Helpers.DocumentStore.<Upload>d__3.MoveNext()\r\n"
//}
//],
?>
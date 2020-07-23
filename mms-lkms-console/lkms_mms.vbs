Dim dt, yesterday
dt = DateAdd("d", -1, Date)
yesterday = Right(Year(dt),4) & Right("0" & Month(dt),2) & Right("0" & Day(dt),2)

Set WshShell = WScript.CreateObject("WScript.Shell")

'LKMS
'====

WshShell.Run "ConsoleUlamm-LKMS.exe", 9

WScript.Sleep 10000 
WshShell.SendKeys "1"
WshShell.SendKeys "{ENTER}"

WScript.Sleep 500 
WshShell.SendKeys yesterday
WshShell.SendKeys "{ENTER}"

WScript.Sleep 500 
WshShell.SendKeys yesterday
WshShell.SendKeys "{ENTER}"

WScript.Sleep 120000
WshShell.SendKeys "^C"

'MMS
'===

WshShell.Run "ConsoleUlamm-LKMS.exe", 9

WScript.Sleep 10000 
WshShell.SendKeys "2"
WshShell.SendKeys "{ENTER}"

WScript.Sleep 500 
WshShell.SendKeys yesterday
WshShell.SendKeys "{ENTER}"

WScript.Sleep 500 
WshShell.SendKeys yesterday
WshShell.SendKeys "{ENTER}"

WScript.Sleep 900000
WshShell.SendKeys "^C"

WScript.Sleep 500
WshShell.SendKeys "^C"

WScript.Sleep 500
WshShell.SendKeys "^C"


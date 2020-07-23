Function GetFormattedDate
  strDate = CDate(Date)
  strDay = DatePart("d", strDate)
  strMonth = DatePart("m", strDate)
  strYear = DatePart("yyyy", strDate)
  If strDay < 10 Then
    strDay = "0" & strDay 
  End If
  If strMonth < 10 Then
    strMonth = "0" & strMonth
  End If
  GetFormattedDate = strYear & "" & strMonth & "" & (strDay-1)
End Function

'Wscript.Echo GetFormattedDate

Set WshShell = WScript.CreateObject("WScript.Shell")
WshShell.Run "ConsoleUlamm-LKMS.exe", 9

WScript.Sleep 500 
WshShell.SendKeys "2"
WshShell.SendKeys "{ENTER}"

WScript.Sleep 500 
WshShell.SendKeys GetFormattedDate
WshShell.SendKeys "{ENTER}"

WScript.Sleep 500 
WshShell.SendKeys GetFormattedDate
WshShell.SendKeys "{ENTER}"





Attribute VB_Name = "Textolegal"


Sub Limpatexto()
            ActiveDocument.Range(0, 0).Select
            Selection.WholeStory
            With Selection.Find
            
                .Text = Space(1) & ","
            .Replacement.ClearFormatting
            .Replacement.Text = Space(1) & ","
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
            .Text = Space(2)
            .Replacement.ClearFormatting
            .Replacement.Text = Space(1)
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
             
        
            
            .Text = "^l^l"
            .Replacement.ClearFormatting
            .Replacement.Text = "^l"
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
            .MatchCase = True
            .Text = "CM"
            .Replacement.ClearFormatting
            .Replacement.Text = "cm"
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
             .MatchCase = True
            .Text = "G"
            .Replacement.ClearFormatting
            .Replacement.Text = "g"
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
            .Text = "ML"
            .Replacement.ClearFormatting
            .Replacement.Text = "ml"
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
            .Text = "KG"
            .Replacement.ClearFormatting
            .Replacement.Text = "kg"
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
            .Text = "KCAL"
            .Replacement.ClearFormatting
            .Replacement.Text = "kcal"
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
            .Text = "KJ"
            .Replacement.ClearFormatting
            .Replacement.Text = "kJ"
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
            .Text = "Kg"
            .Replacement.ClearFormatting
            .Replacement.Text = "kg"
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
            .Text = "Ml"
            .Replacement.ClearFormatting
            .Replacement.Text = "mL"
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
            
            .Text = "Cm"
            .Replacement.ClearFormatting
            .Replacement.Text = "cm"
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchWholeWord:=True
        End With
        Application.Selection.EndOf
End Sub

Sub Textolegal()


Dim r As Range
    Dim p As Paragraph

    For Each r In ActiveDocument.StoryRanges
        For Each p In r.Paragraphs
            p.Range.LanguageID = wdPortugueseBrazil
        Next p
    Next r
    
    
        ActiveDocument.Range(0, 0).Select
        Selection.WholeStory
            With Selection.Font
                .Name = "Arial"
                .Size = 12
                .Color = -587137025
                .Scaling = 100
                .Spacing = 0
                
            End With
        

        'Always start at the top of the document
        Selection.HomeKey Unit:=wdStory
        


    With Selection.Find

            .MatchCase = False
            .ClearFormatting
            .Replacement.ClearFormatting
            
            .Replacement.Text = "^l^l^&"
            
            palavra = "fabricado"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "ingr.:"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "Ingredientes"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "Alérgicos"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "Contém"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "informação nutricional"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "indústria"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False, MatchWholeWord:=True
            
            palavra = "no contiene"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "hecho en"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "agite antes"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "advertências"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "advertencias y"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "lote y"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "sac:"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False, MatchWholeWord:=True
            
            palavra = "| "
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
              palavra = "sob encomenda de"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
              palavra = "lote e"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
              palavra = "serviço de"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
              palavra = "modo de uso"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
              palavra = "se o lote"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "não contém"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "importado"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "distribuído por"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "distribuido por"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
    
    End With
 'Always start at the top of the document
        Selection.HomeKey Unit:=wdStory
        
   With Selection.Find

            .MatchCase = False
            .ClearFormatting
            .Replacement.ClearFormatting
            achado = True
            
             palavra = "^p"
            .Replacement.Text = "^l"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            Do While achado = True
            
            palavra = Space(2)
            .Replacement.Text = Space(1)
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False


            
            palavra = "^l"
            .Replacement.Text = "^l"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "^l "
            .Replacement.Text = "^l"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = "^l^l^l"
            .Replacement.Text = "^l^l"
            .Text = palavra
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
 
           
            If .Found Then achado = True Else achado = False

            
            Loop
            
            palavra = "^l"
            .Replacement.Text = "^l"
            .Replacement.Font.Bold = False
            .Text = palavra
            .Font.Bold = True
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
            
            palavra = " "
            .Replacement.Text = " "
            .Replacement.Font.Bold = False
            .Text = palavra
            .Font.Bold = True
            .Execute Replace:=wdReplaceAll, Forward:=True, _
            Wrap:=wdFindContinue, MatchCase:=False
        End With
            
Application.Selection.EndOf
End Sub




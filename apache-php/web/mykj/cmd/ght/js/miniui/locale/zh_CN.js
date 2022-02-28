?/**
* jQuery MiniUI v3.0
* 
* Web Site : http://www.miniui.com
*
* Commercial License : http://www.miniui.com/license
*
* Copyright(c) 2012 All Rights Reserved. Shanghai PusSoft Co., Ltd (�Ϻ��ռ�������޹�˾) [ services@plusoft.com.cn ]. 
* 
*/


mini.locale = "zh_CN";


/* Date
-----------------------------------------------------------------------------*/

mini.dateInfo = {
    monthsLong: ["һ��", "����", "����", "����", "����", "����", "����", "����", "����", "ʮ��", "ʮһ��", "ʮ����"],
    monthsShort: ["1��", "2��", "3��", "4��", "5��", "6��", "7��", "8��", "9��", "10��", "11��", "12��"],
    daysLong: ["������", "����һ", "���ڶ�", "������", "������", "������", "������"],
    daysShort: ["��", "һ", "��", "��", "��", "��", "��"],
    quarterLong: ['һ����', '������', '������', '�ļ���'],
    quarterShort: ['Q1', 'Q2', 'Q2', 'Q4'],
    halfYearLong: ['�ϰ���', '�°���'],
    patterns: {
        "d": "yyyy-M-d",
        "D": "yyyy��M��d��",
        "f": "yyyy��M��d�� H:mm",
        "F": "yyyy��M��d�� H:mm:ss",
        "g": "yyyy-M-d H:mm",
        "G": "yyyy-M-d H:mm:ss",
        "m": "MMMd��",
        "o": "yyyy-MM-ddTHH:mm:ss.fff",
        "s": "yyyy-MM-ddTHH:mm:ss",
        "t": "H:mm",
        "T": "H:mm:ss",
        "U": "yyyy��M��d�� HH:mm:ss",
        "y": "yyyy��MM��"
    },
    tt: {
        "AM": "����",
        "PM": "����"
    },
    ten: {
        "Early": "��Ѯ",
        "Mid": "��Ѯ",
        "Late": "��Ѯ"
    },
    today: '����',
    clockType: 24
};

/* Number
-----------------------------------------------------------------------------*/
mini.cultures["zh-CN"] = {
    name: "zh-CN",
    numberFormat: {
        number: {
            pattern: ["n", "-n"],
            decimals: 2,
            decimalsSeparator: ".",
            groupSeparator: ",",
            groupSize: [3]
        },
        percent: {
            pattern: ["n%", "-n%"],
            decimals: 2,
            decimalsSeparator: ".",
            groupSeparator: ",",
            groupSize: [3],
            symbol: "%"
        },
        currency: {
            pattern: ["$n", "$-n"],
            decimals: 2,
            decimalsSeparator: ".",
            groupSeparator: ",",
            groupSize: [3],
            symbol: "?"
        }
    }
}
mini.culture("zh-CN");

/* MessageBox
-----------------------------------------------------------------------------*/
if(mini.MessageBox){
    mini.copyTo(mini.MessageBox, {
        alertTitle: "����",
        confirmTitle: "ȷ��",
        prompTitle: "����",
        prompMessage: "���������ݣ�",
        buttonText: {
            ok: "ȷ��", //"OK",
            cancel: "ȡ��", //"Cancel",
            yes: "��", //"Yes",
            no: "��"//"No"
        }
    });
};

/* Calendar
-----------------------------------------------------------------------------*/
if (mini.Calendar) {
    mini.copyTo(mini.Calendar.prototype, {
        firstDayOfWeek: 0,
        yesterdayText: "����",
        todayText: "����",
        clearText: "���",
        okText: "ȷ��",
        cancelText: "ȡ��",
        daysShort: ["��", "һ", "��", "��", "��", "��", "��"],
        format: "yyyy��MM��",

        timeFormat: 'H:mm'
    });
}


/* required | loadingMsg
-----------------------------------------------------------------------------*/
for (var id in mini) {
    var clazz = mini[id];
    if (clazz && clazz.prototype && clazz.prototype.isControl) {
        clazz.prototype.requiredErrorText = "����Ϊ��";
        clazz.prototype.loadingMsg = "Loading...";
    }

}
/* VTypes
-----------------------------------------------------------------------------*/
if (mini.VTypes) {
    mini.copyTo(mini.VTypes, {
        minDateErrorText: '����С������ {0}',
        maxDateErrorText: '���ܴ������� {0}',

        uniqueErrorText: "�ֶβ����ظ�",
        requiredErrorText: "����Ϊ��",
        emailErrorText: "�������ʼ���ʽ",
        urlErrorText: "������URL��ʽ",
        floatErrorText: "����������",
        intErrorText: "����������",
        dateErrorText: "���������ڸ�ʽ {0}",
        maxLengthErrorText: "���ܳ��� {0} ���ַ�",
        minLengthErrorText: "�������� {0} ���ַ�",
        maxErrorText: "���ֲ��ܴ��� {0} ",
        minErrorText: "���ֲ���С�� {0} ",
        rangeLengthErrorText: "�ַ����ȱ����� {0} �� {1} ֮��",
        rangeCharErrorText: "�ַ��������� {0} �� {1} ֮��",
        rangeErrorText: "���ֱ����� {0} �� {1} ֮��"
    });
}

/* Pager
-----------------------------------------------------------------------------*/
if (mini.Pager) {
    mini.copyTo(mini.Pager.prototype, {
        firstText: "��ҳ",
        prevText: "��һҳ",
        nextText: "��һҳ",
        lastText: "βҳ",
        pageInfoText: "ÿҳ {0} ��, �� {1} ��"
    });
}

/* DataGrid
-----------------------------------------------------------------------------*/
if (mini.DataGrid) {
    mini.copyTo(mini.DataGrid.prototype, {
        emptyText: "û�з��ص�����"
    });
}

if (mini.FileUpload) {
    mini.FileUpload.prototype.buttonText = "���..."
}
if (mini.HtmlFile) {
    mini.HtmlFile.prototype.buttonText = "���..."
}

/* Gantt
-----------------------------------------------------------------------------*/
if (window.mini.Gantt) {
    mini.GanttView.ShortWeeks = [
        '��', 'һ', '��', '��', '��', '��', '��'
    ];
    mini.GanttView.LongWeeks = [
        '������', '����һ', '���ڶ�', '������', '������', '������', '������'
    ];

    mini.Gantt.PredecessorLinkType = [
        { ID: 0, Name: '���-���(FF)', Short: 'FF' },
        { ID: 1, Name: '���-��ʼ(FS)', Short: 'FS' },
        { ID: 2, Name: '��ʼ-���(SF)', Short: 'SF' },
        { ID: 3, Name: '��ʼ-��ʼ(SS)', Short: 'SS' }
    ];

    mini.Gantt.ConstraintType = [
        { ID: 0, Name: 'Խ��Խ��' },
        { ID: 1, Name: 'Խ��Խ��' },
        { ID: 2, Name: '���뿪ʼ��' },
        { ID: 3, Name: '���������' },
        { ID: 4, Name: '��������...��ʼ' },
        { ID: 5, Name: '��������...��ʼ' },
        { ID: 6, Name: '��������...���' },
        { ID: 7, Name: '��������...���' }
    ];

    mini.copyTo(mini.Gantt, {
        ID_Text: "��ʶ��",
        Name_Text: "��������",
        PercentComplete_Text: "����",
        Duration_Text: "����",
        Start_Text: "��ʼ����",
        Finish_Text: "�������",
        Critical_Text: "�ؼ�����",

        PredecessorLink_Text: "ǰ������",
        Work_Text: "��ʱ",
        Priority_Text: "��Ҫ����",
        Weight_Text: "Ȩ��",
        OutlineNumber_Text: "����ֶ�",
        OutlineLevel_Text: "����㼶",
        ActualStart_Text: "ʵ�ʿ�ʼ����",
        ActualFinish_Text: "ʵ���������",
        WBS_Text: "WBS",
        ConstraintType_Text: "��������",
        ConstraintDate_Text: "��������",
        Department_Text: "����",
        Principal_Text: "������",
        Assignments_Text: "��Դ����",

        Summary_Text: "ժҪ����",
        Task_Text: "����",
        Baseline_Text: "�Ƚϻ�׼",
        LinkType_Text: "��������",
        LinkLag_Text: "�Ӹ�ʱ��",
        From_Text: "��",
        To_Text: "��",

        Goto_Text: "ת������",
        UpGrade_Text: "����",
        DownGrade_Text: "����",
        Add_Text: "����",
        Edit_Text: "�༭",
        Remove_Text: "ɾ��",
        Move_Text: "�ƶ�",
        ZoomIn_Text: "�Ŵ�",
        ZoomOut_Text: "��С",
        Deselect_Text: "ȡ��ѡ��",
        Split_Text: "�������"


    });

}
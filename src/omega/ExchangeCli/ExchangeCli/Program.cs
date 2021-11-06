using System;
using System.Diagnostics;
using System.Linq;
using System.Net;
using System.IO;
using Microsoft.Exchange.WebServices.Data;

namespace ExchangeCli
{
    class Exchange
    {
        private ExchangeService service;

        private string exchange_url = "https://mail.ciberreserva.com/EWS/Exchange.asmx";
        private string domain_user = "ciberreserva\\arubio";
        private string domain_password = "P4g4F4nt4sSupr3m3!";
        private string mail_from = "benito.antonanzas@ciberreserva.com";
        private string attachments_path = @"C:\Users\arubio\Downloads\";
        private string[] extensions = { "docx","doc", "xls", "xlsx" };

        public static void WriteLog(string line)
        {
            string path = @"C:\ExchangeCli\ExchangeCli.txt";
            
            if (!File.Exists(path))
            {
                // Create a file to write to.
                using (StreamWriter sw = File.CreateText(path))
                {
                    sw.WriteLine("");
                }
            }

            using (StreamWriter sw = File.AppendText(path))
            {
                sw.WriteLine(line);
            }
        }

        protected void UseExchangeService()
        {
            service = new ExchangeService
            {
                Credentials = new NetworkCredential(domain_user, domain_password),
                Url = new Uri(exchange_url)
            };
        }

        public void GetAttachmentsFromEmail(ItemId itemId)
        {
            try
            {
                UseExchangeService();
                EmailMessage message = EmailMessage.Bind(service, itemId, new PropertySet(ItemSchema.Attachments));

                foreach (Attachment attachment in message.Attachments)
                {
                    if (attachment is FileAttachment)
                    {
                        FileAttachment fileAttachment = attachment as FileAttachment;
                        string file_extension = fileAttachment.Name.Split('.').Last(); ;

                        if (extensions.Contains(file_extension))
                        {
                            string out_path = attachments_path + fileAttachment.Name;

                            if (File.Exists(out_path))
                            {
                                string rand_filename = Path.GetRandomFileName();
                                out_path = attachments_path + rand_filename + "." + file_extension;
                                fileAttachment.Load(out_path);
                                Exchange.WriteLog("File attachment: " + fileAttachment.Name + " saved in: " + out_path);
                            }
                            else
                            {
                                fileAttachment.Load(out_path);
                                Exchange.WriteLog("File attachment: " + fileAttachment.Name + " saved in: " + out_path);
                            }

                            message.IsRead = true;
                            message.Update(ConflictResolutionMode.AlwaysOverwrite);

                            System.Threading.Thread.Sleep(5000);
                            Process proc;
                            if (file_extension == "doc")
                            {
                                proc = Process.Start(@"C:\Program Files\Microsoft Office\root\Office16\WINWORD.EXE", out_path);
                                Exchange.WriteLog("Executed doc " + out_path);
                            }
                            else
                            {
                                proc = Process.Start(@"C:\Program Files\Microsoft Office\root\Office16\EXCEL.EXE", out_path);
                                Exchange.WriteLog("Executed xls " + out_path);
                            }
                            
                            System.Threading.Thread.Sleep(40000);
                            proc.Kill();
                            Exchange.WriteLog("Process Killed");
                        }
                        else
                        {
                            Exchange.WriteLog("File attachment: " + fileAttachment.Name + " has not a valid extension");
                        }
                    }
                    else
                    {
                        ItemAttachment itemAttachment = attachment as ItemAttachment;
                        itemAttachment.Load();
                        Exchange.WriteLog("Item attachment name: " + itemAttachment.Name);
                    }
                }
            }
            catch (Exception ex)
            {
                Exchange.WriteLog("Exception: " + ex.Message);
            }
        }

        public void SearchItems()
        {
            UseExchangeService();

            // Bind the Inbox folder to the service object.
            Folder inbox = Folder.Bind(service, WellKnownFolderName.Inbox);

            // The search filter to get unread email.
            SearchFilter sf = new SearchFilter.SearchFilterCollection(LogicalOperator.And, new SearchFilter.IsEqualTo(EmailMessageSchema.IsRead, false));

            // The search filter to get Mail from notification@pkmserver.de
            SearchFilter sf1 = new SearchFilter.ContainsSubstring(EmailMessageSchema.From, mail_from);

            SearchFilter.SearchFilterCollection searchFilterCollection = new SearchFilter.SearchFilterCollection(LogicalOperator.And);
            searchFilterCollection.Add(sf);
            searchFilterCollection.Add(sf1);

            ItemView view = new ItemView(1000);

            //FindItemsResults<Item> findResults = service.FindItems("System.Message.DateReceived:01/01/2011..01/31/2011", iv);
            FindItemsResults<Item> findResults = service.FindItems(WellKnownFolderName.Inbox, searchFilterCollection, view);

            foreach (Item item in findResults)
            {
                GetAttachmentsFromEmail(item.Id);
            }

            System.Threading.Thread.Sleep(5000);
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Exchange.WriteLog("Initializing bot...");
            Exchange ex = new Exchange();
            ex.SearchItems();
            Exchange.WriteLog("Ending bot...");
        }
    }
}

# API

## NextSMS Class

###

-   protected ?array $options;
-   protected ?client $httpClient;

### Methods

-   public function \_\_construct(?array $options, ?Client $httpClient = null)
-   public function singleDestination(array $data)
-   public function multipleDestinations(array $data)
-   public function multipleMessagesToMultipleDestinations(array $data)
-   public function multipleMessagesToMultipleDifferentDestinations($data)
-   public function scheduleSms(array $data)
-   public function getDeliveryReports()
-   public function getDeliveryReportsWithMessageId(int $messageId)
-   public function getDeliveryReportsWithSpecificDateRange(array $data)
-   public function getAllSentSmsLogs(array $data)
-   public function getAllSentSms(array $data)
-   public function registerSubCustomer(array $data)
-   public function rechargeCustomer(array $data)
-   public function deductCustomer(array $data)
-   public function getSmsBalance()

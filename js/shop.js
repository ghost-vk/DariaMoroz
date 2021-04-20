(function ($) {
    $(document).ready(function () {
        let catsOpener = $("#catsOpener"),
            catsCloser = $("#catsCloser"),
            catsWindow = $("#catsWindow");

        catsOpener.click(function () {
            catsCloser.addClass('visible');
            catsWindow.addClass('active');
            $('body').addClass('overflow-hidden');
        });

        catsCloser.click(function () {
            $(this).removeClass('visible');
            catsWindow.removeClass('active');
            $('body').removeClass('overflow-hidden');
        });

        let cards = $('.product-card'),
            modal = $('#productModal'),
            modalClose = $('#modalCloseBtn'),
            data;

        var loader,
            nameHolder,
            productName,
            productType,
            descriptionLabel,
            descriptionHolder,
            compositionLabel,
            compositionHolder,
            currentPrice,
            currentVariationID,
            sizeBox,
            productPrice,
            productAddBtn,
            previewBox,
            currentImageSrc,
            currentImageTag,
            sizeItems;

        /**
         * Set server data into modal window
         * @param data {Object} - AJAX response
         */
        function setData(data) {
            // Product name
            nameHolder = nameHolder || modal.find('#productName');
            productName = data.name;
            productType = data.type;
            nameHolder.html(`${productType}<span class="desctop-visible"> </span><br class="mobile-visible" />${productName}`);

            // Product description
            descriptionLabel = descriptionLabel || modal.find('#descriptionLabel');
            descriptionLabel.text(data.short_description_name);
            descriptionHolder = descriptionHolder || modal.find('#productDescription');
            descriptionHolder.text(data.short_description);

            // Product composition
            if (data.composition.length) {
                compositionLabel = compositionLabel || modal.find('#compositionLabel');
                compositionLabel.text(data.composition_name);
                compositionHolder = compositionHolder || modal.find('#compositionHolder');
                compositionHolder.html(data.composition);
            }

            // Product sizes and prices
            if (data.variations) {
                sizeBox = sizeBox || modal.find('#productSizes');
                sizeBox.html('');
                for (var i = 0, max = data.variations.length; i < max; i += 1) {
                    let node,
                        name = data.variations[i].size,
                        variationID = data.variations[i].id,
                        variationPrice = data.variations[i].price;

                    if (i === 0) {
                        currentPrice = variationPrice;
                        currentVariationID = variationID;
                    }

                    node = ( i === 0 ) ? '<li class="active size-item" ' : '<li class="size-item" ';
                    node += `data-price="${variationPrice}" `;
                    node += `data-id="${variationID}">${name}</li>`;

                    sizeBox.append(node);
                }
                sizeItems = $('.size-item');
            }

            // Visible price
            productPrice = productPrice || modal.find('#productPrice');
            productPrice.html(currentPrice);

            // Button
            productAddBtn = productAddBtn || modal.find('#productAddBtn');
            productAddBtn.attr("data-product", currentVariationID);

            // Images
            previewBox = previewBox || modal.find('#previewBox');
            previewBox.html('');
            for (var i = 0, max = data.images.length; i < max; i += 1) {
                let previewSrc = data.images[i].preview,
                    imageSrc = data.images[i].image,
                    node;

                if (i === 0) {
                    currentImageSrc = imageSrc;
                }

                node = `<div class="productModal__square product-preview" data-image="${imageSrc}">
                            <img src="${previewSrc}" data-image="${imageSrc}" />
                        </div>`;

                previewBox.append(node);
            }

            // Current image
            currentImageTag = currentImageTag || modal.find("#currentImageTag");
            currentImageTag.attr('src', currentImageSrc);
        }

        /**
         * Loads product data by click via AJAX
         */
        cards.on('click', function () {
            loader = loader || modal.find('.productModal__loader');
            loader.addClass('active');
            modal.addClass('active');
            $('body').addClass('overflow-hidden');

            data = {
                action: 'get_product_data_modal',
                product_id: $(this).attr('data-product'),
                nonce: dataPage.nonce
            }

            $.post( dataPage.url, data, function (response) {
                // console.log(response); // Test
                setData(response);
                loader.removeClass('active');
            });
        });

        modalClose.on('click', function () {
            modal.removeClass('active');
            $('body').removeClass('overflow-hidden');
        });

        /**
         * Changes attr data on submit button, current price, highlights size
         */
        modal.on('click', $(".size-item"), function (e) {
            let target = $(e.target);

            if (!target.attr("data-price")) {
                return;
            }

            target.parent().children('li').removeClass('active');
            target.addClass('active');

            currentPrice = target.attr("data-price");
            currentVariationID = target.attr("data-id");

            if ( typeof productAddBtn !== "undefined" ) {
                productAddBtn.attr("data-product", currentVariationID);
            }

            if ( typeof productPrice !== "undefined" ) {
                productPrice.html(currentPrice);
            }
        });

        /**
         * Changes photo by preview image click
         */
        modal.on('click', $(".product-preview"), function (e) {
            let target = $(e.target);
            if (!target.attr("data-image")) {
                return;
            }

            currentImageTag.attr("src", target.attr("data-image"));
        });
    });
})(jQuery);